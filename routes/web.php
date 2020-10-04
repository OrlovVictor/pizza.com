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

/* Shop: products list, product cart actions. */
Route::get('/', 'product\ShopController@index')->name('shop.index');
Route::get('/cart', 'product\ShopController@cart')->name('shop.cart');
Route::get('/cart/get', 'product\ShopController@getCart');
Route::post('/cart/add/{productId}', 'product\ShopController@addProduct');
Route::post('/cart/remove/{productId}', 'product\ShopController@removeProduct');

/* Admin page: products list. */
Route::get('/admin', 'product\AdminController@index')->name('admin.index');
/* Admin page: products CRUD. */
Route::post('/admin/product/create', 'product\AdminController@create')->name('admin.product.create');
Route::post('/admin/product/update/{id}', 'product\AdminController@update')->name('admin.product.update');
Route::post('/admin/product/delete/{id}', 'product\AdminController@delete')->name('admin.product.delete');
