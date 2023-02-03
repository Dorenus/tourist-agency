<?php

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

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('admin/countries')->name('countries-')->group(function () {
    Route::get('/', [T::class, 'index'])->name('index');
    Route::get('/create', [T::class, 'create'])->name('create');
    Route::post('/create', [T::class, 'store'])->name('store');
    Route::get('/edit/{type}', [T::class, 'edit'])->name('edit');
    Route::put('/edit/{type}', [T::class, 'update'])->name('update');
    Route::delete('/delete/{type}', [T::class, 'destroy'])->name('delete');
});

Route::prefix('admin/hotels')->name('hotels-')->group(function () {
    Route::get('/', [T::class, 'index'])->name('index');
    Route::get('/create', [T::class, 'create'])->name('create');
    Route::post('/create', [T::class, 'store'])->name('store');
    Route::get('/edit/{type}', [T::class, 'edit'])->name('edit');
    Route::put('/edit/{type}', [T::class, 'update'])->name('update');
    Route::delete('/delete/{type}', [T::class, 'destroy'])->name('delete');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
