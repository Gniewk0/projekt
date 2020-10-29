<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/users', 'App\Http\Controllers\UsersController@store'); //add
Route::get('/users', 'App\Http\Controllers\UsersController@index'); //add
Route::put('/users/update', 'App\Http\Controllers\UsersController@update'); //add
Route::get('/users/search', 'App\Http\Controllers\UsersController@search'); //add
Route::delete('/users', 'App\Http\Controllers\UsersController@destroy'); //add
