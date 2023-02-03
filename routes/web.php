<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as H;
use App\Http\Controllers\CountryController as C;

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

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('admin/countries')->name('countries-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index');
    Route::get('/create', [C::class, 'create'])->name('create');
    Route::post('/create', [C::class, 'store'])->name('store');
    Route::get('/edit/{type}', [C::class, 'edit'])->name('edit');
    Route::put('/edit/{type}', [C::class, 'update'])->name('update');
    Route::delete('/delete/{type}', [C::class, 'destroy'])->name('delete');
});

Route::prefix('admin/hotels')->name('hotels-')->group(function () {
    Route::get('/', [H::class, 'index'])->name('index');
    Route::get('/create', [H::class, 'create'])->name('create');
    Route::post('/create', [H::class, 'store'])->name('store');
    Route::get('/edit/{type}', [H::class, 'edit'])->name('edit');
    Route::put('/edit/{type}', [H::class, 'update'])->name('update');
    Route::delete('/delete/{type}', [H::class, 'destroy'])->name('delete');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
