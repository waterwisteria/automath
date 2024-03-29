<?php
namespace App\Http\Controllers;
use App\Models\Plans;
use App\Models\Problem;
use App\Models\Quiz;
use App\Models\QuizEntry;
use App\Enums\QuizStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\QuizSolutionRequest;
use App\Http\Requests\CreateQuizRequest;
use App\Quiz\TimeSpentService;
use App\Quiz\Generator;

class QuizController extends Controller
{
    public function solveQuiz(Request $request, TimeSpentService $quizTimeSpent, int $quizId)
    {
        $quiz = Quiz::find($quizId);
        
        // If the quiz exists, it must belong to current user.
        if(($quiz->user_id ?? -1) !== Auth::user()->id)
        {
            return abort(404);
        }

        $quizTimeSpent->start($request);

        return view('Automath/quizzes/solveProblems', [
            'quiz' => $quiz,
            'quizEntries' => $quiz->scopeUnansweredEntries()->get(),
            'questionsAnswered' => $quiz->scopeAnsweredEntries()->count(),
            'quizEntriesCount' => $quiz->quizEntries->count()
        ]);
    }

    public function postQuiz(QuizSolutionRequest $quizSolutionRequest, TimeSpentService $quizTimeSpent, int $id)
    {
        $quiz = Quiz::find($id);
        
        $quiz->gradeSolutions($quizSolutionRequest->validated()['solution']);
        
        $quizTimeSpent->reset($quizSolutionRequest, $quiz);

        if($quiz->scopeUnansweredEntries()->count() === 0)
        {
            $quiz->close();
            $quiz->save();

            return redirect()->route('result.quiz', [ 'id' => $quiz->id ]);
        }

        // $quiz->time_spent was modified so save it
        $quiz->save();

        return redirect()->route('solve.quiz', [ 'id' => $quiz->id ]);
    }

    public function showQuizResults(int $id)
    {
        $quiz = Quiz::find($id);

        if($quiz->status !== QuizStatus::Completed->value)
        {
            return redirect()->route('solve.quiz', [ 'id' => $quiz->id ]);
        }

        return view('Automath/quizzes/quizResults', [
            'quiz' => $quiz,
            'quizEntries' => $quiz->entries,
        ]);
    }

    public function createQuiz()
    {
        return view('cyborg/quiz/create',
        [
            'problems' => Problem::all()
        ]);
    }

    public function postCreateQuiz(CreateQuizRequest $createQuizRequest)
    {
        $quizProblems = $createQuizRequest->validated();

        $quizGenerator = new Generator(Auth::user(), $quizProblems['title']);

        foreach($quizProblems['problem'] as $id => $quantity)
        {
            $quizGenerator->addProblemsRandomSolution(Problem::find($id), $quantity);
        }

        return redirect()->route('solve.quiz', [ 'id' => $quizGenerator->getQuiz()->id ]);
    }
}
