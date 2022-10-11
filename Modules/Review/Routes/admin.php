<?php

use Illuminate\Support\Facades\Route;

Route::get('reviews', [
    'as' => 'admin.reviews.index',
    'uses' => 'ReviewController@index',
    'middleware' => 'can:admin.reviews.index',
]);

Route::get('reviews/{id}/edit', [
    'as' => 'admin.reviews.edit',
    'uses' => 'ReviewController@edit',
    'middleware' => 'can:admin.reviews.edit',
]);

Route::put('reviews/{id}', [
    'as' => 'admin.reviews.update',
    'uses' => 'ReviewController@update',
    'middleware' => 'can:admin.reviews.edit',
]);

Route::delete('reviews/{ids?}', [
    'as' => 'admin.reviews.destroy',
    'uses' => 'ReviewController@destroy',
    'middleware' => 'can:admin.reviews.destroy',
]);

// question 
Route::get('questions', [
    'as' => 'admin.questions.index',
    'uses' => 'QuestionController@index',
    'middleware' => 'can:admin.reviews.index',
]);

Route::delete('questions/{ids?}', [
    'as' => 'admin.questions.destroy',
    'uses' => 'QuestionController@destroy',
    'middleware' => 'can:admin.reviews.destroy',
]);

Route::get('questions/{id}/reply', [
    'as' => 'admin.questions.edit',
    'uses' => 'QuestionController@edit',
    'middleware' => 'can:admin.reviews.edit',
]);

Route::post('questions/{id}/reply/store', [
    'as' => 'admin.questions.reply.store',
    'uses' => 'QuestionController@storeReply',
    'middleware' => 'can:admin.reviews.index',
]);

Route::get('questions/{id}/reply/destroy', [
    'as' => 'admin.questions.reply.destroy',
    'uses' => 'QuestionController@destroyReply',
    'middleware' => 'can:admin.reviews.index',
]);
