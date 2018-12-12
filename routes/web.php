<?php

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
    return redirect()->route('product.list');
});

Auth::routes();

// 產品相關
Route::prefix('product')->group(function () {
    Route::get('/', 'ProductController@index')->name('product.list');

    Route::get('/{id}', 'ProductController@show')->name('product.info');
});

// 訂單相關
Route::prefix('order')->group(function () {
    Route::get('/', 'OrderController@index');

    Route::post('/', 'OrderController@store')->name('order.add')->middleware('auth.member');

    Route::get('/preview', 'OrderController@preview')->name('order.preview');

    Route::get('/confirm', 'OrderController@confirm')->name('order.confirm')->middleware('auth.member');
});

// 購物車相關
Route::prefix('shoppingcart')->group(function () {
    Route::get('/', 'ShoppingCartController@index')->name('shoppingcart.list');

    Route::post('/', 'ShoppingCartController@store')->name('shoppingcart.add');

    Route::delete('/', 'ShoppingCartController@removeAll')->name('shoppingcart.removeall');

    Route::delete('/{id}', 'ShoppingCartController@remove')->name('shoppingcart.remove');
});

// 管理員相關
Route::prefix('admin')->group(function () {
    Route::get('login', 'AdminController@index')->name('admin_login');

    Route::post('login', 'AdminController@login');

    Route::post('logout', 'AdminController@logout');
});
