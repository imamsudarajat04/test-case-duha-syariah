<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Discount\DiscountController;
use App\Http\Controllers\Products\ProductsController;

// Get All Product
Route::get('/', [ProductsController::class, 'index'])->name('home');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/discount/apply', [DiscountController::class, 'apply'])->name('discount.apply');