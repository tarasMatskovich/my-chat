<?php

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('home');
    Route::get('/user/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/{id}', [\App\Http\Controllers\UserController::class, 'user'])->name('user');
    Route::post('/user/update', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete', [\App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
    Route::post('/users', [\App\Http\Controllers\UserController::class, 'users'])->name('users');

    Route::get('/messages/{id}', [\App\Http\Controllers\MessagesController::class, 'message'])->name('messages.message');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home2');
