<?php

use Vinip\Api\Http\Route;

Route::get('/', 'HomeController@index');
Route::post('/users/create', 'UserController@store');
Route::post('/users/login', 'UserController@login');
Route::post('/users/fetch', 'UserController@fetch');
Route::put('/users/update', 'UserController@update');
Route::delete('/about/{id}/delete', 'UserController@remove');




