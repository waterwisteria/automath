<?php
namespace App\Http\Controllers;
use App\Models\Plans;
use App\Models\Problem;
use App\Models\Quiz;
use App\Models\QuizEntry;
use App\Enums\QuizStatus;
use Automath\LearnUnits;
use Automath\QuizzGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function quizzes()
    {
        $quizzes = Quiz::where('user_id', Auth::user()->id)->where('status', \App\Enums\QuizzStatus::Inprogress)->get();

        return view('Automath/quizzes/quizzes', [
            'quizzes' => $quizzes
        ]);
    }

    public function solveQuiz(int $quizId)
    {
        $quiz = Quiz::find($quizId);

        // If the quiz exists, it must belong to current user.
        if(($quiz->user_id ?? 0) !== Auth::user()->id)
        {
            return abort(404);
        }

        $quizEntries = QuizEntry::where('quiz_id', $quizId)->whereNull('solution')->get();

        return view('Automath/quizzes/solveProblems', [
            'quiz' => $quiz,
            'quizEntries' => $quizEntries
        ]);
    }

    public function postQuiz(Request $request, int $id)
    {
        $scoreSoFar = 0;
        $totalScore = 0;
        
        $validated = $request->validate([
            'solution.*' => 'nullable|integer'
        ]);

        // We allow not answering problems. They must be left empty,
        // the validator will return null for those cases. Everything
        // else gets graded and becomes immutable.
        if(isset($validated['solution']) && is_array($validated['solution']))
        {
            foreach($validated['solution'] as $quizEntryId => $solution)
            {
                if($solution !== null)
                {
                    // Grade solution
                    $quizEntry = QuizEntry::find($quizEntryId);
                    $scoreSoFar += $quizEntry->grade($solution);
                    //$totalScore += $quizEntry->getSolver()->totalPoints();
                    $quizEntry->save();
                }
            }
        }

        $quizEntries = QuizEntry::where('quiz_id', $id)->whereNull('solution')->get();
        $quiz = Quiz::find($id);
        
        if(count($quizEntries) === 0)
        {
            //$quiz->status = QuizStatus::Completed;
            //$quiz->score = intval(($scoreSoFar / $totalScore) * 10000);
            $quiz->close();
            //$quiz->save();
            
            return redirect()->route('result.quiz', [ 'id' => $quiz->id ]);
        }
        
        return view('Automath/quizzes/solveProblems', [
            'quiz' => $quiz,
            'quizEntries' => $quizEntries
        ]);
    }

    public function showQuizResults(int $id)
    {
        $quiz = Quiz::find($id);
        $quizEntries = [ ];

        if($quiz->status === QuizStatus::Completed->value)
        {
            $quizEntries = QuizEntry::where('quiz_id', $id)->whereNull('solution')->get();
        }

        else
        {
            return redirect()->route('solve.quiz', [ 'id' => $quiz->id ]);
        }

        return view('Automath/quizzes/quizResults', [
            'quiz' => $quiz,
            'quizEntries' => $quizEntries,
        ]);
    }
}
