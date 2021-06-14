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
    return redirect('products');
});
Route::get('products',[\App\Http\Controllers\ProductController::class,'product_list']);
Route::get('cart',[\App\Http\Controllers\CartController::class,'cart_list']);
Route::post('cart/{product_id}',[\App\Http\Controllers\CartController::class,'save_cart']);
Route::post('edit-cart/{cart_id}/{action}',[\App\Http\Controllers\CartController::class,'edit_cart']);
Route::get('orders',[\App\Http\Controllers\OrderController::class,'order_list']);
Route::post('order/{action}',[\App\Http\Controllers\OrderController::class,'save_order']);
Route::post('retry/payment/{order_number}',[\App\Http\Controllers\OrderController::class,'retry_payment']);
