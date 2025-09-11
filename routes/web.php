<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\ImportController;
use App\Http\Controllers\Teacher\QuizController as TeacherQuizController;
use App\Http\Controllers\Student\QuizController as StudentQuizController;
use App\Http\Controllers\Student\SubmissionController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Teacher\QuestionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Teacher routes
Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {
        Route::get('import', [ImportController::class, 'showUploadForm'])->name('import.form');
        Route::post('import', [ImportController::class, 'import'])->name('import');
        Route::resource('quizzes', TeacherQuizController::class)->only(['show']);
        Route::get('quizzes/history', [TeacherDashboardController::class, 'quizHistory'])->name('quizzes.history');

        Route::get('questions', [QuestionController::class, 'index'])->name('questions.index');
        Route::get('questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('questions', [QuestionController::class, 'store'])->name('questions.store');
        Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
        Route::put('questions/{question}', [QuestionController::class, 'update'])->name('questions.update'); // let op: teacher. prefix al
        Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    });

// Student routes
Route::prefix('student')
    ->name('student.')
    ->group(function () {
        Route::resource('quizzes', StudentQuizController::class)->only(['index','show']);
        Route::post('quizzes/{quiz}/submit', [SubmissionController::class, 'submit'])->name('quizzes.submit');
    });

require __DIR__.'/auth.php';
