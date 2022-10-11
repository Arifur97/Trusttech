<?php

use Illuminate\Support\Facades\Route;

Route::get('products', [
    'as' => 'admin.products.index',
    'uses' => 'ProductController@index',
    'middleware' => 'can:admin.products.index',
]);

Route::get('products/create', [
    'as' => 'admin.products.create',
    'uses' => 'ProductController@create',
    'middleware' => 'can:admin.products.create',
]);

Route::post('products', [
    'as' => 'admin.products.store',
    'uses' => 'ProductController@store',
    'middleware' => 'can:admin.products.create',
]);

Route::get('products/{id}/edit', [
    'as' => 'admin.products.edit',
    'uses' => 'ProductController@edit',
    'middleware' => 'can:admin.products.edit',
]);

Route::put('products/{id}', [
    'as' => 'admin.products.update',
    'uses' => 'ProductController@update',
    'middleware' => 'can:admin.products.edit',
]);

Route::delete('products/{ids}', [
    'as' => 'admin.products.destroy',
    'uses' => 'ProductController@destroy',
    'middleware' => 'can:admin.products.destroy',
]);


// pc builder
Route::get('pc-builder', [
    'as' => 'admin.pcbuilder.index',
    'uses' => 'PcbuilderController@index',
    'middleware' => 'can:admin.products.index',
]);

Route::get('pc-builder/{id}/edit', [
    'as' => 'admin.pcbuilder.edit',
    'uses' => 'PcbuilderController@show',
    'middleware' => 'can:admin.products.index',
]);


Route::delete('pc-builder/{ids?}/destroy', [
    'as' => 'admin.pcbuilder.destroy',
    'uses' => 'PcbuilderController@destroy',
    'middleware' => 'can:admin.products.index',
]);

Route::get('pc-builder/{id}/print', [
    'as' => 'admin.pcbuilder.print',
    'uses' => 'PcbuilderController@print',
    'middleware' => 'can:admin.products.index',
]);