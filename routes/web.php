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
    Route::post('/users/all', [\App\Http\Controllers\UserController::class, 'allUsers'])->name('users.all');

    Route::get('/messages/{id}', [\App\Http\Controllers\MessagesController::class, 'message'])->name('messages.message');
    Route::get('/messages', [\App\Http\Controllers\MessagesController::class, 'index'])->name('messages.messages');

    Route::post('/session/{session}/chats', [\App\Http\Controllers\MessagesController::class, 'chats'])->name('messages.chats');
    Route::post('/session/{session}/read', [\App\Http\Controllers\MessagesController::class, 'read'])->name('messages.read');
    Route::post('/session/unread', [\App\Http\Controllers\SessionController::class, 'unread'])->name('messages.unread');
    Route::post('/session/{session}/clear', [\App\Http\Controllers\MessagesController::class, 'clear'])->name('messages.clear');
    Route::post('/session/{session}/block', [\App\Http\Controllers\BlockController::class, 'block'])->name('messages.block');
    Route::post('/session/{session}/unblock', [\App\Http\Controllers\BlockController::class, 'unblock'])->name('messages.unblock');
    Route::post('/send/{session}', [\App\Http\Controllers\MessagesController::class, 'send'])->name('messages.send');
    Route::post('/session/{session}/getSession', [\App\Http\Controllers\SessionController::class, 'getSession'])->name('session.get');
    Route::post("/sessions", [\App\Http\Controllers\SessionController::class, 'index'])->name('sessions');


    Route::get('/test', [\App\Http\Controllers\SessionController::class, 'test'])->name('test');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home2');
