<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    /* --------------------- Start Page --------------------- */

    Route::get('/', function () {
        return redirect('questions');
    });

    /* --------------------- Auth --------------------- */
    require __DIR__ . '/auth.php';


    /* --------------------- User / Dashboard --------------------- */
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    /* --------------------- User / Notifications --------------------- */
    Route::group([
        'prefix' => 'user/notifications',
        'as' => 'notifications.',
        'middleware' => ['auth']
    ], function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/readAll', [NotificationController::class, 'readAll'])->name('readAll');
        Route::get('/{id}/read', [NotificationController::class, 'read'])->name('read');
    });

    /* --------------------- User / Profile --------------------- */
    Route::group([
        'prefix' => 'profile',
        'as' => 'profile.',
    ], function () {
        Route::get('{id}/', [ProfileController::class, 'index'])->name('index');
    });

    /* --------------------- Questions --------------------- */
    Route::group([
        'prefix' => 'questions',
        'as' => 'questions.',
        'middleware' => ['auth'],

    ], function () {
        Route::get('/create', [QuestionController::class, 'create'])->name('create');
        Route::post('/', [QuestionController::class, 'store'])->name('store');

        Route::get('/{question:slug}/edit', [QuestionController::class, 'edit'])->name('edit');
        Route::put('/{question:slug}', [QuestionController::class, 'update'])->name('update');

        Route::delete('/{question:slug}', [QuestionController::class, 'destroy'])->name('destroy');

        Route::post('/{question:slug}/vote', VoteController::class)->name('vote');
    });

    Route::resource('questions', QuestionController::class)
        ->names('questions')
        ->parameters([
            'questions' => 'question:slug'
        ])
        ->only(['index', 'show']);

    /* --------------------- Answers --------------------- */
    Route::group([
        'prefix' => 'questions/{question:slug}/answers',
        'as' => 'answers.',
        'middleware' => ['auth'],
    ], function () {
        Route::post('/', [AnswerController::class, 'store'])->name('store');
        Route::put('/{answer}', [AnswerController::class, 'update'])->name('update');
        Route::get('/{answer}/edit', [AnswerController::class, 'edit'])->name('edit');
        Route::delete('/{answer}', [AnswerController::class, 'destroy'])->name('destroy');
    });
});
