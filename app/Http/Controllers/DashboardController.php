<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizEntry;
use App\Models\Quiz;
use App\Models\User;
use App\Enums\QuizStatus;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('cyborg/pages/dashboard', [
            'pendingQuizzes' => Quiz::scopePendingQuizzes(Auth::user())->get(),
            'completedQuizzes' => Quiz::scopeByUserState(Auth::user(), QuizStatus::Completed)->count(),
            'bestQuizzes' => Quiz::scopeBestQuizzes(Auth::user())->get(),
            'questionsAnswered' => Quiz::scopeUserAnsweredQuestions(Auth::user())->count(),
            'totalQuizTime' => Quiz::scopeByUserState(Auth::user())->sum('time_spent'),
            'quizChartsData' => $this->getQuizChartVars(Auth::user()),
            'user' => Auth::user()
        ]);
    }

    public function ajaxMoreBestQuizzes()
    {
        return view('cyborg/ajax/best-quizzes', [
            'bestQuizzes' => Quiz::scopeBestQuizzes(Auth::user())->paginate(config('automath.best_quizzes_per_page'))
        ]);
    }

    /**
     * Get array of results and urls to be used for the quiz chart on
     * the dashboard.
     * 
     * @param User $user
     * 
     * @return Array
     * 
     */
    protected function getQuizChartVars(User $user) : Array
    {
        $lastQuizResults = [ ];
        $lastQuizUrls = [ ];
        $quizzesChart = Quiz::scopeByUserState($user, QuizStatus::Completed)->latest()->take(10)->get();

        foreach($quizzesChart as $quiz)
        {
            $lastQuizResults[\App\Quiz\BladeHelper::shortDate($quiz->created_at)] = $quiz->getFinalScore();
            $lastQuizUrls[] = route('result.quiz', [ 'id' => $quiz->id ]);
        }

        return [
            'Results' => array_reverse($lastQuizResults),
            'Urls' => array_reverse($lastQuizUrls)
        ];
    }
}
