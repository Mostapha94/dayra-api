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
define('MAINASSETS', URL::asset('public/dist'));
define('MAINAUPLOADS', URL::asset('public/uploads'));

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth' ], function (){
    Route::get('/',[App\Http\Controllers\Frontend\CartController::class, 'shop'])->name('shop');
    Route::get('/cart',[App\Http\Controllers\Frontend\CartController::class, 'cart'])->name('cart.index');

    Route::post('/add',[App\Http\Controllers\Frontend\CartController::class, 'add'])->name('cart.store');
    Route::post('/update',[App\Http\Controllers\Frontend\CartController::class, 'update'])->name('cart.update');
    Route::post('/remove',[App\Http\Controllers\Frontend\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear',[App\Http\Controllers\Frontend\CartController::class, 'clear'])->name('cart.clear');

});  

Route::group(['middleware' => 'auth:admin' ,'prefix'=>'admin'], function (){
    Route::get('/',[App\Http\Controllers\Admin\AdminController::class, 'index'])->name('backend.index');
    
    //products
    Route::get('/products',[App\Http\Controllers\Admin\ProductController::class, 'index'])->name('backend.product.index');
    Route::get('/product/{id}',[App\Http\Controllers\Admin\ProductController::class, 'show'])->name('backend.product.show');
    Route::post('/datatable/products',[App\Http\Controllers\Admin\ProductController::class, 'datatable'])->name('backend.product.datatable');

    //suppliers
    Route::get('/suppliers',[App\Http\Controllers\Admin\SupplierController::class, 'index'])->name('backend.supplier.index');
    Route::get('/supplier/{id}',[App\Http\Controllers\Admin\SupplierController::class, 'show'])->name('backend.supplier.show');
    Route::post('/datatable/suppliers',[App\Http\Controllers\Admin\SupplierController::class, 'datatable'])->name('backend.supplier.datatable');
});


Route::get('/admin/login',[App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('showAdminLoginForm');
Route::post('/admin/login',[App\Http\Controllers\Auth\LoginController::class, 'storeAdminLogin'])->name('storeAdminLogin');