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
        'news' => \App\Http\Controllers\Admin\NewsController::class,
        'interview_category' => \App\Http\Controllers\Admin\InterviewCategoryController::class,
        'interview_peoples' => \App\Http\Controllers\Admin\InterviewPeoplesController::class,
        'interview' => \App\Http\Controllers\Admin\InterviewController::class,
        'portrait_rejissors' => \App\Http\Controllers\Admin\PortretRejissorsController::class,
        'portrait_actor' => \App\Http\Controllers\Admin\PorTraitActorController::class,
        'portrait_operator' => \App\Http\Controllers\Admin\PortraitOperatorController::class,
        'portrait_composer' => \App\Http\Controllers\Admin\PortraitComposerController::class,
        'portrait_artist' => \App\Http\Controllers\Admin\PortraitArtistController::class,
        'film_dictionary' => \App\Http\Controllers\Admin\FilmDictionaryController::class,
        'cinema_fact' => \App\Http\Controllers\Admin\CinemaFactController::class,
        'artistic_film' => \App\Http\Controllers\Admin\ArtisticFilmController::class,
        'documentary' => \App\Http\Controllers\Admin\DocumentaryController::class,
        'popular_science_film' => \App\Http\Controllers\Admin\PopularScienceFilmController::class,
        'animation' => \App\Http\Controllers\Admin\AnimationController::class,
        'film_analysis' => \App\Http\Controllers\Admin\MovieAnalysisController::class,
        'book' => \App\Http\Controllers\Admin\BooksController::class,
        'aphorism' => \App\Http\Controllers\Admin\AphorismController::class,
        'premiere' => \App\Http\Controllers\Admin\PremiereController::class
    ]);
    Route::post('/new-status', [\App\Http\Controllers\Admin\NewsController::class, 'newStatus'])->name('new-status');
    Route::get('/book/download/{id}', [\App\Http\Controllers\Admin\BooksController::class, 'download'])->name('download');
    Route::get('/interview-status', [\App\Http\Controllers\Admin\InterViewController::class, 'interviewStatus'])->name('interview-status');
});


