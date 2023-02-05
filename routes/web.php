<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController as H;
use App\Http\Controllers\CountryController as C;



// Route::get('/', function () {
//     return view('welcome');
// });



Route::prefix('admin/countries')->name('countries-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index');
    Route::get('/create', [C::class, 'create'])->name('create');
    Route::post('/create', [C::class, 'store'])->name('store');
    Route::get('/edit/{country}', [C::class, 'edit'])->name('edit');
    Route::put('/edit/{country}', [C::class, 'update'])->name('update');
    Route::delete('/delete/{country}', [C::class, 'destroy'])->name('delete');
});

Route::prefix('admin/hotels')->name('hotels-')->group(function () {
    Route::get('/', [H::class, 'index'])->name('index');
    Route::get('/create', [H::class, 'create'])->name('create');
    Route::post('/create', [H::class, 'store'])->name('store');
    Route::get('/edit/{hotel}', [H::class, 'edit'])->name('edit');
    Route::put('/edit/{hotel}', [H::class, 'update'])->name('update');
    Route::delete('/delete/{hotel}', [H::class, 'destroy'])->name('delete');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
