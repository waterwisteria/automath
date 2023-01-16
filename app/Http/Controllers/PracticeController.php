<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quiz;

class PracticeController extends Controller
{
    public function practice()
    {
        $oldestPendingQuiz = Quiz::scopeLatestPendingQuizzes(Auth::user(), 1)->first();

        // Redirect to oldest pending quiz
        if(!empty($oldestPendingQuiz))
        {
            return redirect(route('solve.quiz', [ 'id' => $oldestPendingQuiz->id ]));
        }

        // Otherwise redirect to create a new quiz form
        return redirect(route('create.quiz'));
    }
}
