<?php

use Illuminate\Http\Request;
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
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $reques t) {
//    return $request->user();
//});

//aphorism
Route::get('aphorism', [\App\Http\Controllers\AphorismController::class, 'index'])->name('aphorism');

// news
Route::get('news', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.api.index');
Route::get('news/{id}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.api.show')->middleware('view_count');

//premiere
Route::get('premiere', [\App\Http\Controllers\PremiereController::class, 'index'])->name('premiere.api.index');
Route::get('premiere/{id}', [\App\Http\Controllers\PremiereController::class, 'show'])->name('premiere.api.show');

//analysis
Route::get('movie_analysis', [\App\Http\Controllers\FilmAnalysisController::class, 'index'])->name('movie_analysis.api.index');
Route::get('movie_analysis/{id}', [\App\Http\Controllers\FilmAnalysisController::class,'show'])->name('movie_analysis.api.show');

//interview
Route::get('interview', [\App\Http\Controllers\InterviewController::class, 'index'])->name('interview.api.index');
Route::get('interview/{id}', [\App\Http\Controllers\InterviewController::class, 'show'])->name('interview.api.show');

//person
Route::get('persons', [\App\Http\Controllers\PersonDirectorController::class, 'index'])->name('person.api.index');
Route::get('persons/{id}', [\App\Http\Controllers\PersonDirectorController::class, 'show'])->name('person.api.show');

//film_dictionary
Route::get('film_dictionary', [\App\Http\Controllers\DictionaryController::class, 'dictionary'])->name('dictionary');
Route::get('dictionary', [\App\Http\Controllers\DictionaryController::class, 'index'])->name('dictionary.api.index');
Route::get('dictionary/{id}', [\App\Http\Controllers\DictionaryController::class, 'show'])->name('dictionary.api.show');

//fact
Route::get('cinema_fact', [\App\Http\Controllers\FilmFactController::class, 'index'])->name('cinema.api.index');

//filmography
Route::get('filmography', [\App\Http\Controllers\FilmographyController::class, 'index'])->name('filmography.api.index');
Route::get('filmography/{id}', [\App\Http\Controllers\FilmographyController::class, 'show'])->name('filmography.api.show');

//book
Route::get('book', [\App\Http\Controllers\BookController::class, 'index'])->name('book.api.index');
Route::get('book/{id}', [\App\Http\Controllers\BookController::class, 'show'])->name('book.api.show');
Route::get('book-file-download/{id}', [\App\Http\Controllers\BookController::class, 'fileDownload']);
//category
Route::get('categories', [\App\Http\Controllers\CategoriesController::class, 'index'])->name('category');

//GlobalSearch
Route::get('search', [\App\Http\Controllers\SearchController::class, 'search']);

