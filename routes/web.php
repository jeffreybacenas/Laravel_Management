<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BooksController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::get('/registration', 'registration')->name('registration');
});

Route::controller(DashboardController::class)->group(function (){
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(BooksController::class)->group(function (){
    Route::get('/books', 'index')->name('books');
});

