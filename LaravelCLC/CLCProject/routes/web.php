<?php

use Illuminate\Support\Facades\Route;

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
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

//Default Laravel home page
Route::get('/', function () {
    return view('home');
});

//Login form page
Route::get('/Login', function () {
    return view('login');
});

//Submits form data from login form to login controller
Route::post('/loginHandler', 'LoginController@index');

//Registration form page
Route::get('/Register', function () {
    return view('register');
});

//Takes search form input and sends it to the job search controller
Route::get('/jobSearch', 'JobSearchController@index');

//Uses arguments from the form used to take the user here to display the information of the relevant job
Route::post('/viewJob', 'JobController@index');

// Submits form data from registration form to registration controller
Route::post('/registrationHandler', 'RegistrationController@index');

// Url for access to all API calls having to do with a user profile
Route::resource('/userrest', 'UserProfileRestController');

// Url for access to all API calls having to do with a job
Route::resource('/jobrest', 'JobRestController');

Route::group(['middleware' => 'secure'], function(){
    //Displays a user's affinity groups and suggested affinity groups as long as they're loggedin
    Route::get('/groups', 'AffinityGroupController@index');

    //Allows the user to apply for a job
    Route::post('/jobApply', 'JobController@apply');

    //Allows the user to revoke their job application
    Route::post('/jobCancel', 'JobController@cancelApplication');

    //Submits form data to a controller so that it can then return back the proper information for the user's profile
    Route::get('/userProfile', 'UserProfileController@index');

    //Submits form data from the edit user profile form to the controller to commit user edits to the database
    Route::post('/editUserInfo', 'UserEditController@editUserInfo');

    //Submits form data from the edut user address form to the controller to commit user edits to the database
    Route::post('/editUserAddress', 'UserEditController@editAddress');

    //Submits form data to create a new education record to the controller
    Route::post('/addEducation', 'PortfolioController@addEducation');

    //Submits form data from the education edit form to the controller
    Route::post('/editEducation', 'PortfolioController@editEducation');

    //Submits the id of the education record to remove to the controller
    Route::post('/removeEducation', 'PortfolioController@removeEducation');

    //Submits form data to create a new experience record to the controller
    Route::post('/addExperience', 'PortfolioController@addExperience');

    //Submits form data from the experience edit form to the controller
    Route::post('/editExperience', 'PortfolioController@editExperience');

    //Submits the id of the experience record to remove to the controller
    Route::post('/removeExperience', 'PortfolioController@removeExperience');

    //Submits form data to create a new skill to the controller
    Route::post('/addSkill', 'PortfolioController@addSkill');

    //Submits id of the skill to be deleted from the database
    Route::post('/removeSkill', 'PortfolioController@removeSkill');

    //Takes the user's input for creating a group and passes it to the appropriate controller
    Route::post('/createGroup', 'AffinityGroupController@newGroup');

    //Takes the user's input to allow for the editing of an existing owned affinity group
    Route::post('/editGroup', 'AffinityGroupController@editGroup');

    //Allows the owner of a group to delete one of their groups
    Route::post('/deleteGroup', 'AffinityGroupController@deleteGroup');

    //Allows a user to join an affinity group
    Route::post('/joinGroup', 'AffinityMemberController@joinGroup');

    //Allows a user to leave a joined affinity group
    Route::post('/leaveGroup', 'AffinityMemberController@leaveGroup');
});

Route::group(['middleware' => 'admin'], function(){
    //Form for creating a new job posting
    Route::get('/createJob', function() {
        return view('createJob');
    });

    //Gets job data from the database and sends it to the job view
    Route::get('/jobAdmin', 'JobAdminController@index');

    //Submits form data to job controller to create new job entry
    Route::post('/newJobHandler', 'JobController@createJob');

    //Submits form data from edit form to the controller
    Route::post('/jobEditHandler', 'JobAdminController@editJob');

    //Submits the id of the job to be removed to the controller
    Route::post('/jobRemoveHandler', 'JobAdminController@removeJob');

    //Loads the user admin page after going through the admin controller and getting all user data
    Route::get('/userAdmin', 'UserAdminController@index');

    //Submits form data from editing a user to the controller
    Route::post('/userEditHandler', 'UserAdminController@editUser');

    //Submits form data from the user admin page to the controller so that a user can be deleted
    Route::post('/userRemoveHandler', 'UserAdminController@removeUser');
});

//Goes to the signout controller method to flush the current session data so that the user is signed out
Route::get('/SignOut', 'SignOutController@index');