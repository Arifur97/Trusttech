<?php

use Illuminate\Support\Facades\Route;

Route::get('user/login', 'AuthController@getLogin')->name('login');
Route::post('user/login', 'AuthController@postLogin')->name('login.post');

Route::get('login/{provider}', 'AuthController@redirectToProvider')->name('login.redirect');
Route::get('login/{provider}/callback', 'AuthController@handleProviderCallback')->name('login.callback');

Route::get('user/logout', 'AuthController@getLogout')->name('logout');

Route::get('user/register', 'AuthController@getRegister')->name('register');
Route::post('user/register', 'AuthController@postRegister')->name('register.post');

Route::get('password/reset', 'AuthController@getReset')->name('reset');
Route::post('password/reset', 'AuthController@postReset')->name('reset.post');
Route::get('password/reset/{email}/{code}', 'AuthController@getResetComplete')->name('reset.complete');
Route::post('password/reset/{email}/{code}', 'AuthController@postResetComplete')->name('reset.complete.post');

