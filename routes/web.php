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
Route::get('/products', 'Customer\ProductController@index');
Route::get('/about-us', function () {
    return view('customer.aboutUs');
});
Route::get('/logout', 'Customer\LoginController@logout');

Route::group(['middleware' => 'noLoginRequired'], function() {
    Route::post('/login', 'Customer\LoginController@authenticate');
    Route::post('/register', 'Customer\LoginController@create');
});

Route::group(['middleware' => 'loginRequired'], function() {
    Route::get('/cart', 'Customer\CartController@index');
    Route::post('/cart/save', 'Customer\CartController@saveItem');
    Route::get('/cart/delete/{id}', 'Customer\CartController@deleteItem');

    Route::get('/order/list', 'Customer\OrderController@index');
    Route::post('/order/checkout', 'Customer\OrderController@checkout');
    Route::get('/order/cancel/{refnum}', 'Customer\OrderController@cancel');
    Route::get('/edit-profile', function () {
        return view('customer.editProfile')->with([
            'user' => \Illuminate\Support\Facades\Auth::user()
        ]);
    });
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
    Route::get('/admin/products', 'Admin\ProductController@index');
    Route::post('/admin/products/save', 'Admin\ProductController@save');
    Route::get('admin/products/delete/{id}', 'Admin\ProductController@delete');
    Route::get('/admin/brands', function () {
        return view('admin.brands');
    });
    Route::get('/admin/edit-profile', function () {
        return view('customer.editProfile')->with([
            'user' => \App\Services\Session::get('admin')
        ]);
    });
    Route::get('/admin/order/list', 'Admin\OrderController@index');
    Route::post('/admin/order/setDelivery', 'Admin\OrderController@setDeliveryDate');
    Route::get('/admin/order/updatePayment/{refnum}/{isPaid}', 'Admin\OrderController@approvePayment');
    Route::get('/admin/accounts', function () {
        return view('admin.accounts');
    });
});
