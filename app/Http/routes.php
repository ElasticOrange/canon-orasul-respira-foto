<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::controller('/register', 'RegistrationController');

});

Route::controller('/admin', 'AdminController');

Route::controller('/profile', 'ProfileController');
Route::controller('/facebook', 'FacebookController');
Route::controller('/upload-image', 'UploadImageController');
Route::controller('/cum-functioneaza', 'HowItWorksController');
Route::controller('/', 'HomeController');
