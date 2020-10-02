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

Route::get('/', 'product\ShopController@index')->name('shop.index');
Route::get('/admin', 'product\AdminController@index')->name('admin.index');

/* Products: CRUD. */
Route::post('/admin/product/update/{id}', 'product\AdminController@update')->name('admin.product.update');
Route::post('/admin/product/delete/{id}', 'product\AdminController@delete')->name('admin.product.delete');
