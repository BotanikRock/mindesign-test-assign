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

Route::group(['prefix' => '/'], function () {
    Route::get('/', 'CatalogController@index')->name('catalog-index');

    Route::get('/category/{categorySlug}', 'CatalogController@category')->name('catalog-category');

    Route::get('/product/{productID}', 'CatalogController@product')->name('catalog-product');

    Route::get('search', 'CatalogController@search')->name('catalog-search');
});