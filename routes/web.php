<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController as H;
use App\Http\Controllers\CountryController as C;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;





// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [F::class, 'home'])->name('start');
Route::get('/hotel/{hotel}', [F::class, 'showHotel'])->name('show-hotel');
Route::get('/cat/{country}', [F::class, 'showCatHotels'])->name('show-cats-hotels');
Route::post('/add-to-cart', [F::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [F::class, 'cart'])->name('cart');
Route::post('/cart', [F::class, 'updateCart'])->name('update-cart');
Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order');



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
    Route::get('/create', [H::class, 'create'])->name('create')->middleware('roles:A|M|C');
    Route::post('/create', [H::class, 'store'])->name('store');
    Route::get('/edit/{hotel}', [H::class, 'edit'])->name('edit');
    Route::put('/edit/{hotel}', [H::class, 'update'])->name('update');
    Route::get('/show/{hotel}', [H::class, 'show'])->name('show')->middleware('roles:A|M|C');
    Route::delete('/delete/{hotel}', [H::class, 'destroy'])->name('delete');
    Route::get('/show/{hotel}', [H::class, 'show'])->name('show')->middleware('roles:A|M|C');
    Route::get('/pdf/{hotel}', [H::class, 'pdf'])->name('pdf')->middleware('roles:A|M|C');
});

Route::prefix('admin/orders')->name('orders-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::put('/edit/{order}', [O::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete')->middleware('roles:A');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
