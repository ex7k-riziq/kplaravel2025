<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::get('/', [UserController::class, 'welcome'])->name('welcome');
Route::get('/{blog:slug}', [UserController::class, 'show'])->name('blogarticle');

Route::get('/app', function (){
    return view('layouts.app');
})->name('app');

Route::resource('blog', AppController::class);

Route::get('/chart/blog-data', [UserController::class, 'chartData']);


Route::group(['prefix' => 'app'], function (){
    Route::get('/dashboard', [AppController::class, 'dashboard'])->name('dashboard.index');
    
    Route::get('/user', [AppController::class, 'user'])->name('dashboard.user');
    Route::middleware(['auth'])->group(function (){
        Route::get('/user/create', [AppController::class, 'createuser'])->name('dashboard.usercreate');
        Route::post('/user/store', [AppController::class, 'userstore'])->name('dashboard.userstore');
        Route::put('/user/{user}', [AppController::class, 'userupdate'])->name('dashboard.userupdate');
        Route::get('/user/{user}/edit', [AppController::class, 'useredit'])->name('dashboard.useredit');
        Route::delete('/user/{user}', [AppController::class, 'userdelete'])->name('dashboard.userdelete');
        });

    Route::get('/blog', [AppController::class, 'blog'])->name('dashboard.blog');
    Route::middleware(['auth'])->group(function (){
        Route::get('/blog/create', [AppController::class, 'createblog'])->name('dashboard.blogcreate');
        Route::post('/blog/store', [AppController::class, 'blogstore'])->name('dashboard.blogstore');
        Route::put('/blog/{blog}', [AppController::class, 'blogupdate'])->name('dashboard.blogupdate');
        Route::get('/blog/{blog}/edit', [AppController::class, 'blogedit'])->name('dashboard.blogedit');
        Route::delete('/blog/{blog}', [AppController::class, 'blogdelete'])->name('dashboard.blogdelete');
    });
    
    Route::middleware(['auth'])->group(function (){
        Route::get('/category', [AppController::class, 'category'])->name('dashboard.category');
        Route::get('/category/create', [AppController::class, 'createcategory'])->name('dashboard.categorycreate');
        Route::post('/category/store', [AppController::class, 'categorystore'])->name('dashboard.categorystore');
        Route::put('/category/{category}', [AppController::class, 'categoryupdate'])->name('dashboard.categoryupdate');
        Route::get('/category/{category}/edit', [AppController::class, 'categoryedit'])->name('dashboard.categoryedit');
        Route::delete('/category/{category}', [AppController::class, 'categorydelete'])->name('dashboard.categorydelete');
    });
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
