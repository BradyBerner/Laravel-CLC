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
 * 2-10-19
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

//Loads the user admin page after going through the admin controller and getting all user data
Route::get('/userAdmin', 'UserAdminController@index');

//Submits form data from editing a user to the controller
Route::post('/userEditHandler', 'UserAdminController@editUser');

//Submits form data from the user admin page to the controller so that a user can be deleted
Route::post('/userRemoveHandler', 'UserAdminController@removeUser');

//Submits form data to a controller so that it can then return back the proper information for the user's profile
Route::get('/userProfile', 'UserProfileController@index');

//Submits form data from the edit user profile form to the controller to commit user edits to the database
Route::post('/editUserInfo', 'UserEditController@editUserInfo');

//Submits form data from the edut user address form to the controller to commit user edits to the database
Route::post('/editUserAddress', 'UserEditController@editAddress');

Route::post('/removeEducation', 'UserEditController@removeEducation');

Route::post('/editEducation', 'UserEditController@editEducation');

Route::post('/addEducation', 'UserEditController@addEducation');

//Goes to the signout controller method to flush the current session data so that the user is signed out
Route::get('/SignOut', 'SignOutController@index');