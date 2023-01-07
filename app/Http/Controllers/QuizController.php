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
use App\Quiz\TimeSpentService;

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
            'quizEntries' => $quiz->getUnansweredEntries()
        ]);
    }

    public function postQuiz(QuizSolutionRequest $quizSolutionRequest, TimeSpentService $quizTimeSpent, int $id)
    {
        $quiz = Quiz::find($id);
        
        $quiz->gradeSolutions($quizSolutionRequest->validated()['solution']);
        
        $quizTimeSpent->reset($quizSolutionRequest, $quiz);

        $quizEntries = $quiz->getUnansweredEntries();

        if(count($quizEntries) === 0)
        {
            $quiz->close();
            $quiz->save();

            return redirect()->route('result.quiz', [ 'id' => $quiz->id ]);
        }

        // $quiz->time_spent was modified so save it
        $quiz->save();

        return view('Automath/quizzes/solveProblems', [
            'quiz' => $quiz,
            'quizEntries' => $quizEntries
        ]);
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
            'quizEntries' => $quiz->getUnansweredEntries(),
        ]);
    }

    public function createQuiz()
    {
        return view('cyborg/quiz/create');
    }
}
