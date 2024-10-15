<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BiddingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

Route::redirect('/', '/articles');

Route::resource('articles',   ArticleController::class);
Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');

Route::resource('biddings',   BiddingController::class);
Route::resource('categories', CategoryController::class);
Route::resource('messages',   MessageController::class);

Route::resource('users',      UserController::class)->except('show', 'update');
Route::get('/users/login', [UserController::class, 'show'])->name('users.show');
Route::post('/users/login', [UserController::class, 'update'])->name('users.update');

Route::post('/forgot-password', [UserController::class, 'password'])->name('users.password');
Route::get('/new-password', [UserController::class, 'newpassword'])->name('password.reset');
Route::post('/new-password', [UserController::class, 'changepassword'])->name('password.change');


// Na het opgeven van een mail adres -> mail versturen met link en een random token DONE
// ga je naar een pagina met 2 invul velden waar je nieuwe wachtwoord invult DONE
// dit stuur je op MET de token
// aan de hand van de token zoek je de user op, wachtwoord wijzigen
// na wachtwoord wijzigen naar inlog scherm