<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quiz;

class PracticeController extends Controller
{
    public function practice()
    {
        $user = Auth::user();
        
        // Redirect to oldest pending quiz
        $oldestPendingQuiz = Quiz::scopePendingQuizzes(Auth::user())->orderBy('created_at', 'asc')->first();
        0/0;
        dd($oldestPendingQuiz);
        // otherwise redirect to create a quiz page
        
    }
}
