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
Route::get('news', [\App\Http\Controllers\NewsController::class, 'main'])->name('news.main');
Route::get('news_category_filter', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.api.index');
Route::get('news_item/{id}', [\App\Http\Controllers\NewsController::class, 'newsItem'])->name('news.item');

//premiere
Route::get('premiere', [\App\Http\Controllers\PremiereController::class, 'premiere'])->name('premiere');
Route::get('premiere_item/{id}', [\App\Http\Controllers\PremiereController::class, 'premiereItem']);

//analysis
Route::get('movie_analysis', [\App\Http\Controllers\FilmAnalysisController::class, 'movieList'])->name('list');
Route::get('movie_item/{item_id}', [\App\Http\Controllers\FilmAnalysisController::class,'movieItem'])->name('movie.item');

//interview
Route::get('interview', [\App\Http\Controllers\InterviewController::class, 'interview'])->name('interview');
Route::get('interview_item_filter/{id}', [\App\Http\Controllers\InterviewController::class, 'interviewItemFilter']);

//person
Route::get('persons', [\App\Http\Controllers\PersonDirectorController::class, 'personFilter'])->name('person.filter');
Route::get('person/{id}', [\App\Http\Controllers\PersonDirectorController::class, 'person'])->name('person');

//film_dictionary
Route::get('film_dictionary', [\App\Http\Controllers\DictionaryController::class, 'dictionary'])->name('dictionary');
Route::get('dictionary_item_list', [\App\Http\Controllers\DictionaryController::class, 'dictionaryItemList'])->name('dictionary.item.list');
Route::get('dictionary_item/{id}', [\App\Http\Controllers\DictionaryController::class, 'dictionaryItem'])->name('dictionary.item');

//fact
Route::get('cinema_fact', [\App\Http\Controllers\FilmFactController::class, 'index'])->name('cinema.fact');

//filmography
Route::get('filmography', [\App\Http\Controllers\FilmographyController::class, 'filmography'])->name('filmography');
Route::get('filmography_item/{id}', [\App\Http\Controllers\FilmographyController::class, 'filmographyItem'])->name('filmography.item');

//book
Route::get('book_filter', [\App\Http\Controllers\BookController::class, 'bookFilter'])->name('book.filter');
Route::get('book_item/{id}', [\App\Http\Controllers\BookController::class, 'bookItem'])->name('book.item');

//category
Route::get('categories', [\App\Http\Controllers\CategoriesController::class, 'index'])->name('category');




