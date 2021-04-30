<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api']], function () {
    //auth
    Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

    //categories
    Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::get('/category/{id}', [App\Http\Controllers\Api\CategoryController::class, 'show']);

    //products
    Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('/product/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);
    Route::post('/add-product', [App\Http\Controllers\Api\ProductController::class, 'store']);
    Route::post('/update-product/{id}', [App\Http\Controllers\Api\ProductController::class, 'update']);
    Route::post('/delete-product/{id}', [App\Http\Controllers\Api\ProductController::class, 'destroy']);

    Route::group(['middleware'=>'jwt.verify'], function() {
        //logout
        Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
     
        //orders
        Route::get('/orders', [App\Http\Controllers\Api\OrderController::class, 'index']);
        Route::get('/order/{id}', [App\Http\Controllers\Api\OrderController::class, 'show']);
        Route::post('/add-order', [App\Http\Controllers\Api\OrderController::class, 'store']);
        Route::post('/update-order/{id}', [App\Http\Controllers\Api\OrderController::class, 'update']);
        Route::post('/delete-order/{id}', [App\Http\Controllers\Api\OrderController::class, 'destroy']);
        Route::post('/checkout', [App\Http\Controllers\Api\OrderController::class, 'checkout']);

    });

});
