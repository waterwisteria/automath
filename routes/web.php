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

Route::get('/', [ App\Http\Controllers\HomepageController::class, 'home' ]);

Route::get('/learn/unit/{slug}', [ App\Http\Controllers\PracticeController::class, 'learnUnitNow' ])->name('learn.unit');

Route::get('/learn/units', [ App\Http\Controllers\PracticeController::class, 'showLearnUnits' ]);

Route::get('/practice', [ App\Http\Controllers\PracticeController::class, 'practice' ])
->middleware([ 'auth' ]);

Route::get('/problems', [ App\Http\Controllers\Automath\ProblemsController::class, 'home' ])
    ->middleware([ 'auth' ]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
