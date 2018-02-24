<?php

Route::get('/', function () {
    return view('home');
})->name('home');

Auth::routes();

Route::get('/tokens', 'TokensController@index')->name('tokens');
Route::post('/tokens', 'TokensController@store')->name('tokens.store');
Route::get('/tokens/create', 'TokensController@create')->name('tokens.create');

Route::get('/configuration', 'ConfigurationController@index')->name('configuration');
Route::post('/configuration', 'ConfigurationController@save')->name('configuration.save');
Route::put('/configuration', 'ConfigurationController@save')->name('configuration.save');

Route::put('/test', 'TokensController@test')->name('tokens.test');