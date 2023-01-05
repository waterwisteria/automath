<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function()
{
    Route::get('/quizzes', [ App\Http\Controllers\QuizController::class, 'quizzes' ]);
    Route::get('/quiz/{id}', [ App\Http\Controllers\QuizController::class, 'solveQuiz' ])->name('solve.quiz');
    Route::post('/quiz/{id}', [ App\Http\Controllers\QuizController::class, 'postQuiz' ])->name('post.quiz');
    Route::get('/quiz/results/{id}', [ App\Http\Controllers\QuizController::class, 'showQuizResults' ])->name('result.quiz');
});

Route::get('/', [ App\Http\Controllers\HomepageController::class, 'home' ]);
Route::get('/dashboard', [ App\Http\Controllers\DashboardController::class, 'dashboard' ])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/create-quiz', [ App\Http\Controllers\QuizController::class, 'createQuiz' ])->middleware(['auth', 'verified'])->name('create.quiz');

// @TODO Clean up old controlers, delete...
Route::get('/learn/unit/{slug}', [ App\Http\Controllers\PracticeController::class, 'learnUnitNow' ])->name('learn.unit');
Route::get('/learn/units', [ App\Http\Controllers\PracticeController::class, 'showLearnUnits' ]);
Route::get('/problems', [ App\Http\Controllers\Automath\ProblemsController::class, 'home' ])->middleware([ 'auth' ]);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ ProfileController::class, 'edit' ])->name('profile.edit');
    Route::patch('/profile', [ ProfileController::class, 'update' ])->name('profile.update');
    Route::delete('/profile', [ ProfileController::class, 'destroy' ])->name('profile.destroy');
});

Route::get('/theme/cyborg', function()
{
    return view('cyborg-theme/pages/home');
});

Route::get('/theme/cyborg/browse', function()
{
    return view('cyborg-theme/pages/browse');
});

Route::get('/theme/cyborg/details', function()
{
    return view('cyborg-theme/pages/details');
});

Route::get('/theme/cyborg/streams', function()
{
    return view('cyborg-theme/pages/streams');
});

Route::get('/theme/cyborg/profile', function()
{
    return view('cyborg-theme/pages/profile');
});

require __DIR__ . '/auth.php';