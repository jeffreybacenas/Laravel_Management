<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CirculationController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\DVDController;
use App\Http\Controllers\SystemLogsController;
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

Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'LoginController@index')->name('login');
    Route::get('/registration', 'LoginController@registration')->name('registration');
    Route::post('/registration/store', 'LoginController@store')->name('registration.store');
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
    Route::get('/user', 'index')->name('user');
});

Route::controller(CatalogController::class)->group(function (){
    Route::get('/catalog', 'index')->name('catalog');
});

Route::controller(CirculationController::class)->group(function (){
    Route::get('/bookandreturn', 'index')->name('bookandreturn');
});

Route::controller(MagazineController::class)->group(function (){
    Route::get('/magazines', 'index')->name('magazines');
});

Route::controller(DVDController::class)->group(function (){
    Route::get('/dvd', 'index')->name('dvd');
});

Route::controller(SystemLogsController::class)->group(function (){
    Route::get('/systemlogs', 'index')->name('systemlogs');
});
