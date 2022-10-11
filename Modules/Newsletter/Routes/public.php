<?php

use Illuminate\Support\Facades\Route;

Route::post('user/subscribers', 'SubscriberController@store')->name('subscribers.store');

