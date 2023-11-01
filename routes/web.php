<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/single-product/{id}', [ProductController::class, 'single_product'])->name('single-product');
Route::get('/cart', [CartController::class, 'checkout'])->name('cart');
Route::post('/checkout', [CartController::class, 'store'])->name('checkout.store');
Route::post('/checkoutdelete/{id}', [CartController::class, 'delete'])->name('checkoutdelete');
Route::post('/cartitem/{id}', [CartController::class, 'cartitem'])->name('cartitem');
Route::post('/order', [OrderController::class, 'storeorder'])->name('order');
