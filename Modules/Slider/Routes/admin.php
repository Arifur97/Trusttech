<?php

use Illuminate\Support\Facades\Route;

Route::get('sliders', [
    'as' => 'admin.sliders.index',
    'uses' => 'SliderController@index',
    'middleware' => 'can:admin.sliders.index',
]);

Route::get('sliders/create', [
    'as' => 'admin.sliders.create',
    'uses' => 'SliderController@create',
    'middleware' => 'can:admin.sliders.create',
]);

Route::post('sliders', [
    'as' => 'admin.sliders.store',
    'uses' => 'SliderController@store',
    'middleware' => 'can:admin.sliders.create',
]);

Route::get('sliders/{id}/edit', [
    'as' => 'admin.sliders.edit',
    'uses' => 'SliderController@edit',
    'middleware' => 'can:admin.sliders.edit',
]);

Route::put('sliders/{id}', [
    'as' => 'admin.sliders.update',
    'uses' => 'SliderController@update',
    'middleware' => 'can:admin.sliders.edit',
]);

Route::delete('sliders/{ids?}', [
    'as' => 'admin.sliders.destroy',
    'uses' => 'SliderController@destroy',
    'middleware' => 'can:admin.sliders.destroy',
]);

Route::get('slider-options', [
    'as' => 'admin.slider_options.index',
    'uses' => 'SliderOptionController@index',
    'middleware' => 'can:admin.slider_options.index',
]);

Route::get('slider-options/create', [
    'as' => 'admin.slider_options.create',
    'uses' => 'SliderOptionController@create',
    'middleware' => 'can:admin.slider_options.create',
]);

Route::post('slider-options', [
    'as' => 'admin.slider_options.store',
    'uses' => 'SliderOptionController@store',
    'middleware' => 'can:admin.slider_options.create',
]);

Route::get('slider-options/{id}/edit', [
    'as' => 'admin.slider_options.edit',
    'uses' => 'SliderOptionController@edit',
    'middleware' => 'can:admin.slider_options.edit',
]);

Route::put('slider-options/{id}', [
    'as' => 'admin.slider_options.update',
    'uses' => 'SliderOptionController@update',
    'middleware' => 'can:admin.slider_options.edit',
]);

Route::delete('slider-options/{ids?}', [
    'as' => 'admin.slider_options.destroy',
    'uses' => 'SliderOptionController@destroy',
    'middleware' => 'can:admin.slider_options.destroy',
]);

// banner - two col
Route::get('banners/two_col', [
    'as' => 'admin.banners.twocol.index',
    'uses' => 'BannerController@indexTwoCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::post('banners/two_col', [
    'as' => 'admin.banners.twocol.store',
    'uses' => 'BannerController@storeTwoCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::post('banners/two_col/{id}', [
    'as' => 'admin.banners.twocol.update',
    'uses' => 'BannerController@updateTwoCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::get('banners/two_col/destroy/{id}', [
    'as' => 'admin.banners.twocol.destroy',
    'uses' => 'BannerController@destroyTwoCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::get('banners/two_col/enable/{id}', [
    'as' => 'admin.banners.twocol.enable',
    'uses' => 'BannerController@twoColEnable',
    'middleware' => 'can:admin.sliders.index',
]);

// banner - three col
Route::get('banners/three_col', [
    'as' => 'admin.banners.threecol.index',
    'uses' => 'BannerController@indexThreeCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::post('banners/three_col', [
    'as' => 'admin.banners.threecol.store',
    'uses' => 'BannerController@storeThreeCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::post('banners/three_col/{id}', [
    'as' => 'admin.banners.threecol.update',
    'uses' => 'BannerController@updateThreeCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::get('banners/three_col/destroy/{id}', [
    'as' => 'admin.banners.threecol.destroy',
    'uses' => 'BannerController@destroyThreeCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::get('banners/three_col/enable/{id}', [
    'as' => 'admin.banners.three_col.enable',
    'uses' => 'BannerController@threeColEnable',
    'middleware' => 'can:admin.sliders.index',
]);


// banner - four col
Route::get('banners/four_col', [
    'as' => 'admin.banners.fourcol.index',
    'uses' => 'BannerController@indexFourCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::post('banners/four_col', [
    'as' => 'admin.banners.fourcol.store',
    'uses' => 'BannerController@storeFourCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::post('banners/four_col/{id}', [
    'as' => 'admin.banners.fourcol.update',
    'uses' => 'BannerController@updateFourCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::get('banners/four_col/destroy/{id}', [
    'as' => 'admin.banners.fourcol.destroy',
    'uses' => 'BannerController@destroyFourCol',
    'middleware' => 'can:admin.sliders.index',
]);

Route::get('banners/four_col/enable/{id}', [
    'as' => 'admin.banners.four_col.enable',
    'uses' => 'BannerController@fourColEnable',
    'middleware' => 'can:admin.sliders.index',
]);
