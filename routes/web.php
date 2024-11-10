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
        'interview' => \App\Http\Controllers\Admin\InterViewController::class,
        'portret' => \App\Http\Controllers\Admin\PortretController::class,
        'director' => \App\Http\Controllers\Admin\DirectorController::class,
    ]);
    Route::post('/new-status', [\App\Http\Controllers\Admin\NewsController::class, 'newStatus'])->name('new-status');
    Route::post('/interview-status', [\App\Http\Controllers\Admin\InterViewController::class, 'interviewStatus'])->name('interview-status');
});
