<?php


Route::get('{provider}/auth','SocialsController@auth')->name('social.auth');
Route::get('{provider}/redirect', 'SocialsController@auth_callback')->name('social.callback');

Route::resource('/todo', 'TodosController');



Auth::routes();

Route::get('/home', 'TodosController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});
