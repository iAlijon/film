<?php

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
Route::get('login', [\App\Http\Controllers\AuthController::class, 'loginShowForm'])->name('login');
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('adm.login');
Route::group(['middleware' => 'auth', 'prefix' => 'admin'] ,function (){
    Route::get('/', [\App\Http\Controllers\Admin\Dashboard::class, 'index'])->name('dashboard');
    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::resources([
        'aphorism' => \App\Http\Controllers\Admin\AphorismController::class,
        'news' => \App\Http\Controllers\Admin\NewsController::class,
        'premiere' => \App\Http\Controllers\Admin\PremiereController::class,
        'interview' => \App\Http\Controllers\Admin\InterviewController::class,
        'interview_peoples' => \App\Http\Controllers\Admin\InterviewPeoplesController::class,
        'person' => \App\Http\Controllers\Admin\PersonController::class,
        'film_dictionary' => \App\Http\Controllers\Admin\FilmDictionaryController::class,
        'cinema_fact' => \App\Http\Controllers\Admin\CinemaFactController::class,
        'film_analysis' => \App\Http\Controllers\Admin\MovieAnalysisController::class,
        'filmography' => \App\Http\Controllers\Admin\FilmographyController::class,
        'book' => \App\Http\Controllers\Admin\BooksController::class,
        'categories' => \App\Http\Controllers\Admin\PersonCategoryController::class,
    ]);
    Route::post('/new-status', [\App\Http\Controllers\Admin\NewsController::class, 'newStatus'])->name('new-status');
    Route::get('/book/download/{id}', [\App\Http\Controllers\Admin\BooksController::class, 'download'])->name('download');
    Route::get('/interview-status', [\App\Http\Controllers\Admin\InterviewController::class, 'interviewStatus'])->name('interview-status');
    Route::get('order_category', [\App\Http\Controllers\Admin\PersonCategoryController::class, 'order'])->name('order_category');
    Route::get('telegram_user', [\App\Http\Controllers\Admin\TelegramUsers::class, 'index'])->name('telegram_user');
});

Route::get('auth/google', [\App\Http\Controllers\GoogleController::class, 'redirect']);
Route::get('auth/google/callback', [\App\Http\Controllers\GoogleController::class, 'callback']);
