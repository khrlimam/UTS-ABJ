<?php


Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('ospf')->middleware('auth')->group(function() {
    Route::resource('ospf', 'OspfController');
});