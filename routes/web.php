<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AppController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/app', function (){
    return view('layouts.app');
})->name('app');

// Route::get('/dashboard', function (){
//     return view('dashboard.index');
// })->name('dashboard');

// Route::get('/appblog', function (){
//     return view('dashboard.blog');
// })->name('appblog');

// Route::get('/appuser', function (){
//     return view('dashboard.user');
// })->name('appuser');

Route::group(['prefix' => 'app'], function (){
    Route::get('/dashboard', [AppController::class, 'dashboard'])->name('dashboard.index');
    
    Route::get('/user', [AppController::class, 'user'])->name('dashboard.user');
    Route::get('/user/create', [AppController::class, 'createuser'])->name('dashboard.usercreate');
    Route::post('/user/store', [AppController::class, 'userstore'])->name('dashboard.userstore');
    Route::put('/user/{id}', [AppController::class, 'userupdate'])->name('dashboard.userupdate');
    Route::get('/user/{id}/edit', [AppController::class, 'useredit'])->name('dashboard.useredit');
    Route::delete('/user/{id}', [AppController::class, 'userdelete'])->name('dashboard.userdelete');

    Route::get('/blog', [AppController::class, 'blog'])->name('dashboard.blog');
    Route::get('/blog/create', [AppController::class, 'createblog'])->name('dashboard.blogcreate');
    Route::post('/blog/store', [AppController::class, 'blogstore'])->name('dashboard.blogstore');
    Route::put('/blog/{id}', [AppController::class, 'blogupdate'])->name('dashboard.blogupdate');
    Route::get('/blog/{id}/edit', [AppController::class, 'blogedit'])->name('dashboard.blogedit');
    Route::delete('/blog/{id}', [AppController::class, 'blogdelete'])->name('dashboard.blogdelete');
});

Route::group(['prefix' => 'main'], function () {
    Route::get('/home', [UserController::class, 'home'])->name('main.home');
    Route::get('/user', [UserController::class, 'index'])->name('main.user');
    Route::get('/blog', [BlogController::class, 'index'])->name('main.blog');
});

Route::group(['prefix' => 'crud'], function(){
    Route::get('/create', [UserController::class, 'create'])->name('crud.create');
    Route::get('/update', [UserController::class, 'update'])->name('crud.update');
});

// Route::get('/user', [UserController::class, 'index'])->name('user');
// Route::get('/blog', [BlogController::class, 'index'])->name('blog');
// Route::get('/create', [UserController::class, 'create'])->name('create');
// Route::get('/update', [UserController::class, 'update'])->name('update');