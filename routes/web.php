<?php

use App\Http\Controllers\AccountancyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecapController;
use App\Http\Controllers\StockController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('/accountancies', AccountancyController::class)->except(['show']);

    Route::resource('/stocks', StockController::class)->except(['show']);

    Route::view('/recaps', 'recap.index')->name('recaps.index');

    Route::get('/recaps/accountancy', [RecapController::class, 'accountancy'])
        ->name('recaps.accountancy');

    Route::get('/recaps/stock', [RecapController::class, 'stock'])
        ->name('recaps.stock');
});
