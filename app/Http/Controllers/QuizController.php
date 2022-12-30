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
    /**
     * At what time the quiz was started.
     * 
     */
    public const QUIZ_START_TIME = 'quiz_start_time';

    public function quizzes()
    {
        $quizzes = Quiz::where('user_id', Auth::user()->id)->where('status', \App\Enums\QuizzStatus::Inprogress)->get();

        return view('Automath/quizzes/quizzes', [
            'quizzes' => $quizzes
        ]);
    }

    public function solveQuiz(Request $request, int $quizId)
    {
        $quiz = Quiz::find($quizId);

        // Store quiz start time in session. If present already blank
        // it out, previous quiz must have been abandoned.
        $request->session()->put(self::QUIZ_START_TIME, time());
        
        // If the quiz exists, it must belong to current user.
        if(($quiz->user_id ?? 0) !== Auth::user()->id)
        {
            return abort(404);
        }

        $quizEntries = QuizEntry::where('quiz_id', $quizId)->whereNull('solution')->get();

        return view('Automath/quizzes/solveProblems', [
            'quiz' => $quiz,
            'quizEntries' => $quizEntries,
            'qst' => $request->session()->get(self::QUIZ_START_TIME, -1)
        ]);
    }

    public function postQuiz(Request $request, int $id)
    {
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
                    $quizEntry->grade($solution);
                    $quizEntry->save();
                }
            }
        }

        $quizEntries = QuizEntry::where('quiz_id', $id)->whereNull('solution')->get();
        $quiz = Quiz::find($id);

        
        // Compute time spent from quiz start time and store it in
        // model regardless of errors.
        $quiz->time_spent += time() - $request->session()->get(self::QUIZ_START_TIME, time());
        $request->session()->put(self::QUIZ_START_TIME, time());

        if(count($quizEntries) === 0)
        {
            $quiz->close();
            $quiz->save();

            return redirect()->route('result.quiz', [ 'id' => $quiz->id ]);
        }

        $quiz->save();

        return view('Automath/quizzes/solveProblems', [
            'quiz' => $quiz,
            'quizEntries' => $quizEntries,
            'qst' => $request->session()->get(self::QUIZ_START_TIME, -1)
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
