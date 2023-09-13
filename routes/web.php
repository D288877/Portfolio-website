<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentController;
use App\Models\Quiz;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    $quizzes = Quiz::all();
    return view('dashboard', ['quizzes' => $quizzes]);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware('admin')->group(function () {
        Route::get('/quiz/create', [QuizController::class, 'create'])->name('quizzes.save');
        Route::post('/quiz/create', [QuizController::class, 'save']);
        Route::get('/StudentView', [StudentController::class, 'view'])->name('studentView');
    });
    Route::get('/quiz/{quizId}', [QuizController::class, 'showQuiz']);
    Route::post('/quiz/submit', [QuizController::class, 'submitQuiz']);
});

require __DIR__ . '/auth.php';
