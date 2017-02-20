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


// CUSTOMER RELATED PAGES
Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', function () {
    return view('customer.welcome');
});
Route::get('/products', function () {
    return view('customer.products');
});
Route::get('/about-us', function () {
    return view('customer.aboutUs');
});
Route::get('/logout', 'Customer\LoginController@logout');

Route::group(['middleware' => 'noLoginRequired'], function() {
    Route::post('/login', 'Customer\LoginController@authenticate');
    Route::post('/register', 'Customer\LoginController@create');
});

Route::group(['middleware' => 'loginRequired'], function() {
    // Add to cart, update profile, view cart/orders page here
});

// ADMIN RELATED PAGES
Route::get('/admin/logout', 'Admin\LoginController@logout');

Route::group(['middleware' => 'noLoginRequired'], function() {
    Route::get('/admin', function () {
        return redirect('/admin/login');
    });
    Route::get('/admin/login', function () {
        return view('admin.login');
    });
    Route::post('/admin/login', 'Admin\LoginController@authenticate');
});

Route::group(['middleware' => 'loginRequired'], function() {
    Route::get('/admin/home', function () {
        return view('admin.home');
    });
    Route::get('/admin/products', function () {
        return view('customer.products');
    });
});
