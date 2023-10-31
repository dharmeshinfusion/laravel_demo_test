<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/single_product/{id}', [App\Http\Controllers\HomeController::class, 'single_product'])->name('single_product');
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'checkout'])->name('cart');
Route::post('/checkout', [App\Http\Controllers\HomeController::class, 'store'])->name('checkout.store');
Route::post('/checkoutdelete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('checkoutdelete');
Route::post('/order', [App\Http\Controllers\HomeController::class, 'storeorder'])->name('order');
