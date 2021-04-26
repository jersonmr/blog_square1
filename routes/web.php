<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('posts/create', [\App\Http\Controllers\PostController::class, 'create'])
        ->name('posts.create');

    Route::post('posts', [\App\Http\Controllers\PostController::class, 'store'])
        ->name('posts.store');

//    Route::resource('posts', \App\Http\Controllers\PostController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
