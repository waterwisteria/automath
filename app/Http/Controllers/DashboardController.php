<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\QuizEntry;
use App\Models\User;
use \App\Enums\QuizStatus;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $queryCompletedQuizzesBuilder = Quiz::getByUserState(Auth::user());
        $quizCharts = $this->getQuizChartVars(Auth::user());

        return view('cyborg/pages/dashboard', [
            'pendingQuizzes' => Quiz::getByUserState(Auth::user(), QuizStatus::Inprogress)->latest()->take(5)->get(),
            'questionsAnswered' => Quiz::getUserAnsweredQuestionsCount(Auth::user()),
            'totalQuizTime' => Quiz::where('user_id', Auth::user()->id)->sum('time_spent'),
            'completedQuizzes' => $queryCompletedQuizzesBuilder->count(),
            'bestQuizzes' => $queryCompletedQuizzesBuilder->orderBy('score', 'desc')->take(6)->get(),
            'lastQuizResults' => $quizCharts['Results'],
            'lastQuizUrls' => $quizCharts['Urls'],
            'user' => Auth::user()
        ]);
    }

    protected function getQuizChartVars(User $user) : Array
    {
        $lastQuizResults = [ ];
        $lastQuizUrls = [ ];
        $quizzesChart = Quiz::getByUserState($user)->latest()->take(10)->get();
        
        foreach($quizzesChart as $quiz)
        {
            $lastQuizResults[\App\Quiz\BladeHelper::shortDate($quiz->created_at)] = $quiz->getFinalScore();
            $lastQuizUrls[] = route('result.quiz', [ 'id' => $quiz->id ]);
        }

        return [
            'Results' => $lastQuizResults,
            'Urls' => $lastQuizUrls
        ];
    }
}
