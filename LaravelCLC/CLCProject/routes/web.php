<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

// Default Laravel home page
Route::get('/', function () {
    return view('home');
});

// Login form page
Route::get('/Login', function () {
    return view('login');
});

// Submits form data from login form to login controller
Route::post('/loginHandler', 'LoginController@index');

// Registration form page
Route::get('/Register', function () {
    return view('register');
});

// Submits form data from registration form to registration controller
Route::post('/registrationHandler', 'RegistrationController@index');

Route::get('/userAdmin', function() {
    return view('userAdmin');
});

//TODO: create signout controller
Route::get('/SignOut', 'SignOutController@index');