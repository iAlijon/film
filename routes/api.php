<?php

use App\Http\Controllers\GoogleController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', [\App\Http\Controllers\LoginController::class, 'login'])->name('api_login');
Route::get('auth/google', [\App\Http\Controllers\GoogleController::class, 'redirect']);
Route::get('auth/google/callback', [\App\Http\Controllers\GoogleController::class, 'callback']);
Route::get('aphorism', [\App\Http\Controllers\AphorismController::class, 'index'])->name('aphorism');
Route::get('film_digests', [\App\Http\Controllers\PremiereController::class, 'index'])->name('premiere.api.index');
Route::get('film_diagnostics', [\App\Http\Controllers\FilmAnalysisController::class, 'index'])->name('movie_analysis.api.index');
Route::get('film_catalogs', [\App\Http\Controllers\FilmographyController::class, 'index'])->name('filmography.api.index');
Route::get('film_grids', [\App\Http\Controllers\KinogidController::class, 'index']);
Route::get('books', [\App\Http\Controllers\BookController::class, 'index'])->name('book.api.index');
Route::get('categories', [\App\Http\Controllers\CategoriesController::class, 'index'])->name('category');
Route::get('search', [\App\Http\Controllers\SearchController::class, 'search']);
Route::post('/telegram/webhook', [\App\Http\Controllers\TelegramController::class, 'handle']);

//Route::get('news', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.api.index');
//Route::get('interview', [\App\Http\Controllers\InterviewController::class, 'index'])->name('interview.api.index');
//Route::get('persons', [\App\Http\Controllers\PersonDirectorController::class, 'index'])->name('person.api.index');
//Route::get('letters_category', [\App\Http\Controllers\DictionaryController::class, 'letters'])->name('letters');
//Route::get('dictionary', [\App\Http\Controllers\DictionaryController::class, 'index'])->name('dictionary.api.index');
//Route::get('cinema_fact', [\App\Http\Controllers\FilmFactController::class, 'index'])->name('cinema.api.index');

Route::get('aphorism', [\App\Http\Controllers\AphorismController::class, 'index'])->name('aphorism');
Route::get('film_digests/{id}', [\App\Http\Controllers\PremiereController::class, 'show'])->name('film_digest.api.show');
Route::get('film_diagnostics/{id}', [\App\Http\Controllers\FilmAnalysisController::class,'show'])->name('film_diagnostics.api.show');
Route::get('film_catalogs/{id}', [\App\Http\Controllers\FilmographyController::class, 'show'])->name('film_catalogs.api.show');
Route::get('film_grids/{id}', [\App\Http\Controllers\KinogidController::class, 'show'])->name('film_grids.api.show');
Route::get('books/{id}', [\App\Http\Controllers\BookController::class, 'show'])->name('book.api.show');
Route::get('books/file_download/{id}', [\App\Http\Controllers\BookController::class, 'fileDownload'])->name('book.file_download.api.show');

//Route::get('news/{id}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.api.show')->middleware('view_count');
//Route::get('interview/{id}', [\App\Http\Controllers\InterviewController::class, 'show'])->name('interview.api.show');
//Route::get('persons/{id}', [\App\Http\Controllers\PersonDirectorController::class, 'show'])->name('person.api.show');
//Route::get('dictionary/{id}', [\App\Http\Controllers\DictionaryController::class, 'show'])->name('dictionary.api.show');

Route::group(['middleware' => 'ApiAuth'], function (){
//    Route::get('news/{id}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.api.show')->middleware('view_count');
//    Route::get('premiere/{id}', [\App\Http\Controllers\PremiereController::class, 'show'])->name('premiere.api.show');
//    Route::get('movie_analysis/{id}', [\App\Http\Controllers\FilmAnalysisController::class,'show'])->name('movie_analysis.api.show');
//    Route::get('interview/{id}', [\App\Http\Controllers\InterviewController::class, 'show'])->name('interview.api.show');
//    Route::get('persons/{id}', [\App\Http\Controllers\PersonDirectorController::class, 'show'])->name('person.api.show');
//    Route::get('dictionary/{id}', [\App\Http\Controllers\DictionaryController::class, 'show'])->name('dictionary.api.show');
//    Route::get('filmography/{id}', [\App\Http\Controllers\FilmographyController::class, 'show'])->name('filmography.api.show');
//    Route::get('book/{id}', [\App\Http\Controllers\BookController::class, 'show'])->name('book.api.show');
});
