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


Route::get('aphorism', [\App\Http\Controllers\AphorismController::class, 'index'])->name('aphorism');
Route::get('news', [\App\Http\Controllers\NewsController::class, 'main'])->name('news.main');
Route::get('premiere', [\App\Http\Controllers\PremiereController::class, 'premiere'])->name('premiere');
Route::get('premiere_item/{id}', [\App\Http\Controllers\PremiereController::class, 'premiereItem']);
Route::get('movie_analysis', [\App\Http\Controllers\FilmAnalysisController::class, 'movieList'])->name('list');
Route::get('movie_item/{item_id}', [\App\Http\Controllers\FilmAnalysisController::class,'movieItem'])->name('movie.item');
Route::get('movie_category', [\App\Http\Controllers\FilmAnalysisController::class, 'category']);
Route::get('interview', [\App\Http\Controllers\InterviewController::class, 'interview'])->name('interview');
Route::get('interview_category', [\App\Http\Controllers\InterviewController::class, 'interviewCategory'])->name('interview.category');
Route::get('interview_category_filter', [\App\Http\Controllers\InterviewController::class, 'interviewByCategoryFilter'])->name('interview.category.filter');
Route::get('interview_item_filter/{id}', [\App\Http\Controllers\InterviewController::class, 'interviewItemFilter']);
Route::get('person_filter', [\App\Http\Controllers\PersonDirectorController::class, 'personFilter'])->name('person.filter');
Route::get('person_group', [\App\Http\Controllers\PersonDirectorController::class, 'personGroup'])->name('person.group');
Route::get('person/{id}', [\App\Http\Controllers\PersonDirectorController::class, 'person'])->name('person');
Route::get('film_dictionary', [\App\Http\Controllers\DictionaryController::class, 'dictionary'])->name('dictionary');
Route::get('dictionary_item', [\App\Http\Controllers\DictionaryController::class, 'dictionaryItem'])->name('dictionary.item');
Route::get('cinema_fact', [\App\Http\Controllers\FilmFactController::class, 'index'])->name('cinema.fact');
Route::get('filmography_category', [\App\Http\Controllers\FilmographyController::class, 'filmographyGroup'])->name('filmography.category');
Route::get('filmography', [\App\Http\Controllers\FilmographyController::class, 'filmography'])->name('filmography');
Route::get('filmography_item/{id}', [\App\Http\Controllers\FilmographyController::class, 'filmographyItem'])->name('filmography.item');
Route::get('book', [\App\Http\Controllers\BookCantroller::class, 'index'])->name('book');
Route::get('book_filter', [\App\Http\Controllers\BookCantroller::class, 'bookFilter'])->name('book.filter');
Route::get('book_item/{id}', [\App\Http\Controllers\BookCantroller::class, 'bookItem'])->name('book.item');




