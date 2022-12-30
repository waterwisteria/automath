<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Quiz;
use \App\Models\QuizEntry;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $queryCompletedQuizzes = Quiz::where('user_id', Auth::user()->id)->where('status', \App\Enums\QuizStatus::Completed);

        $completedQuizzes = $queryCompletedQuizzes->count();
        $bestQuizzes = $queryCompletedQuizzes->orderBy('score', 'desc')->take(6)->get();
        $questionsAnswered = Quiz::join('quiz_entries', 'quizzes.id', '=', 'quiz_entries.quiz_id')
            ->whereNotNull('quiz_entries.solution')
            ->where('quizzes.user_id', Auth::user()->id)
            ->count();

        $quizzesChart = Quiz::where('user_id', Auth::user()->id)->where('status', \App\Enums\QuizStatus::Completed)->orderBy('id', 'asc')->latest()->take(10)->get();
        $lastQuizResults = [ ];
        $lastQuizLabels = [ ];
        
        foreach($quizzesChart as $quiz)
        {
            $lastQuizResults[] = $quiz->getFinalScore();
            $lastQuizLabels[] = $quiz->updated_at->format('M-d');
        }
        
        $pendingQuizzes = Quiz::where('user_id', Auth::user()->id)->where('status', \App\Enums\QuizStatus::Inprogress)->get();

        return view('cyborg/pages/dashboard', [
            'completedQuizzes' => $completedQuizzes,
            'questionsAnswered' => $questionsAnswered,
            'bestQuizzes' => $bestQuizzes,
            'pendingQuizzes' => $pendingQuizzes,
            'lastQuizResults' => $lastQuizResults,
            'lastQuizLabels' => $lastQuizLabels,
            'user' => Auth::user()
        ]);
    }
}
