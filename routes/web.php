<?php

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
    return redirect('/home');
});

Route::get('/home', function () {
    return view('customer.welcome');
});

Route::get('/about-us', function () {
    return view('customer.aboutUs');
});

Route::post('/login', 'Customer\LoginController@authenticate');
Route::post('/register', 'Customer\LoginController@create');
Route::get('/logout', 'Customer\LoginController@logout');
