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
use App\Http\Controllers\ReportController;
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
Route::redirect('/', '/login');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/performLogin', 'performLogin')->name('performLogin');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/registration', 'registration')->name('registration');
    Route::post('/registration/store', 'store')->name('registration.store');
});

Route::middleware('auth')->group(function () {

    Route::controller(DashboardController::class)->group(function (){
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(BooksController::class)->group(function (){
        Route::get('/books', 'index')->name('books');
        Route::post('/books/store', 'store')->name('books.store');
        Route::get('/books/edit/{id}', 'edit')->name('books.edit');
        Route::delete('/books/delete/{id}', 'delete')->name('books.delete');
    });

    Route::controller(MagazineController::class)->group(function (){
        Route::get('/magazines', 'index')->name('magazines');
        Route::post('/magazines/store', 'store')->name('magazines.store');
        Route::get('/magazines/edit/{id}', 'edit')->name('magazines.edit');
        Route::delete('/magazines/delete/{id}', 'delete')->name('magazines.delete');
    });
    
    Route::controller(DVDController::class)->group(function (){
        Route::get('/dvd', 'index')->name('dvd');
        Route::post('/dvd/store', 'store')->name('dvd.store');
        Route::get('/dvd/edit/{id}', 'edit')->name('dvd.edit');
        Route::delete('/dvd/delete/{id}', 'delete')->name('dvd.delete');
    });

    Route::controller(CategoryController::class)->group(function (){
        Route::get('/category', 'index')->name('category');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::delete('/category/delete/{id}', 'delete')->name('category.delete');
    });
    
    Route::controller(UserController::class)->group(function (){
        Route::get('/user', 'index')->name('user');
        Route::post('/user/store', 'store')->name('user.store');
        Route::get('/user/edit/{id}', 'edit')->name('user.edit');
        Route::delete('/user/delete/{id}', 'delete')->name('user.delete');
    });
    
    Route::controller(CatalogController::class)->group(function (){
        Route::get('/catalog', 'index')->name('catalog');
    });
    
    Route::controller(CirculationController::class)->group(function (){
        Route::get('/bookandreturn', 'index')->name('bookandreturn');
        Route::post('/bookandreturn/store', 'store')->name('bookandreturn.store');
        Route::get('/bookandreturn/edit/{id}', 'edit')->name('bookandreturn.edit');
        Route::delete('/bookandreturn/delete/{id}', 'delete')->name('bookandreturn.delete');
    });

    Route::controller(SystemLogsController::class)->group(function (){
        Route::get('/systemlogs', 'index')->name('systemlogs');
    });

    Route::controller(ReportController::class)->group(function (){
        Route::get('/reports', 'index')->name('reports');
        Route::get('/reports/excel', 'excel')->name('reports.excel');
        Route::get('/reports/pdf', 'pdf')->name('reports.pdf');
    });

});



