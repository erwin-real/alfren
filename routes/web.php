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

//Route::get('/', function () { return view('dashboard'); });
Route::get('/', 'DashboardController@dashboard');
Route::post('/orders/create', 'OrderController@proceed');
Route::get('/orders/export/{id}', 'OrderController@export');

Route::get('/guides/stocks', 'GuideController@stocks');
Route::get('/guides/products', 'GuideController@products');
Route::get('/guides/orders', 'GuideController@orders');
Route::get('/guides/capacities', 'GuideController@capacities');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('stocks', 'StockController');
Route::resource('products', 'ProductController');
Route::resource('capacities', 'CapacityController');
//Route::resource('orders', 'OrderController');

Route::resource('orders', 'OrderController')->except([
    'edit', 'update'
]);

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');
