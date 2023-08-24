<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CirculationController;
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

Route::controller(CategoryController::class)->group(function (){
    Route::get('/category', 'index')->name('category');
});

Route::controller(UserController::class)->group(function (){
    Route::get('/usermanagement', 'index')->name('usermanagement');
});

Route::controller(CatalogController::class)->group(function (){
    Route::get('/catalogmanagement', 'index')->name('catalogmanagement');
});

Route::controller(CirculationController::class)->group(function (){
    Route::get('/booksandreturn', 'index')->name('booksandreturn');
});
