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
//        'interview' => \App\Http\Controllers\Admin\InterViewController::class,
//        'actor' => \App\Http\Controllers\Admin\ActorController::class,

        // conversation

        'actor_conversation' => \App\Http\Controllers\Admin\ActorConversationController::class,
        'people_film' => \App\Http\Controllers\Admin\PeopleFilmController::class,
        'rejissor' => \App\Http\Controllers\Admin\RejissorController::class,
        'dramaturgy' => \App\Http\Controllers\Admin\DramaturgyController::class,
        'operator' => \App\Http\Controllers\Admin\OperatorsController::class,
        'composer' => \App\Http\Controllers\Admin\ComposersController::class,
        'other' => \App\Http\Controllers\Admin\OtherPeopleController::class,
        'director' => \App\Http\Controllers\Admin\DirectorController::class,

        //portrait

        'portrait_rejissors' => \App\Http\Controllers\Admin\PortretRejissorsController::class,
        'portrait_actor' => \App\Http\Controllers\Admin\PorTraitActorController::class,
        'portrait_operator' => \App\Http\Controllers\Admin\PortraitOptertorController::class,
        'portrait_composer' => \App\Http\Controllers\Admin\PortraitComposerController::class,
        'portrait_artist' => \App\Http\Controllers\Admin\PortraitArtistController::class,
//        'portret' => \App\Http\Controllers\Admin\PortretController::class,

        //film_dictionary
        'film_dictionary' => \App\Http\Controllers\Admin\FilmDictionaryController::class,
        'cinema_fact' => \App\Http\Controllers\Admin\CinemaFactController::class,
        'artistic_film' => \App\Http\Controllers\Admin\ArtisticFilmController::class,
    ]);
    Route::post('/new-status', [\App\Http\Controllers\Admin\NewsController::class, 'newStatus'])->name('new-status');
//    Route::post('/interview-status', [\App\Http\Controllers\Admin\InterViewController::class, 'interviewStatus'])->name('interview-status');
});
