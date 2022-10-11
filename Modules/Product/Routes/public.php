<?php

use Illuminate\Support\Facades\Route;

Route::get('offers', 'ProductController@offer')->name('products.offer');
Route::get('products', 'ProductController@index')->name('products.index');
Route::get('{slug}', 'ProductController@show')->name('products.show');


Route::get('products/suggestions', 'SuggestionController@index')->name('suggestions.index');

Route::post('products/{id}/price', 'ProductPriceController@show')->name('products.price.show');

// pc builder
Route::get('products/pc-builder', 'PcbuilderController@index')->name('pcbuilder.index');
Route::get('products/pc-builder/preview', 'PcbuilderController@show')->name('pcbuilder.preview');
Route::get('products/pc-builder/print', 'PcbuilderController@print')->name('pcbuilder.print');
Route::middleware('auth')->group(function () {
    Route::post('products/pc-builder/save', 'PcbuilderController@store')->name('pcbuilder.save');
    Route::post('products/pc-builder/get-a-quote', 'PcbuilderController@store')->name('pcbuilder.quote');
});