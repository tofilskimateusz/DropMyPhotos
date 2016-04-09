<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'HomeController@home');
    Route::get('/login', 'Auth\LoginController@form');
    Route::get('/login/fb-callback', 'Social\FacebookController@LoginCallback');
    Route::get('/login/gd-callback', 'Social\GoogleDriveController@loginCallback');
});

Route::group(['middleware' => ['web','auth']], function () {

    Route::get('/home', 'HomeController@index');
    Route::get('/login/googledrive', [ 'uses' =>'Social\GoogleDriveController@login', 'as' => '/login/googledrive']);
    Route::get('/logout/googledrive', 'Social\GoogleDriveController@logout');


    // Integration Part
    //----------------------

    // Facebook

    Route::get('/social/integrate/facebook/', [ 'uses' => 'IntegrationController@showServiceAlbums', 'as' => 'facebook.showServiceAlbums']);
    Route::get('/social/integrate/facebook/{album_id}', [ 'uses' => 'IntegrationController@showServiceAlbumPictures', 'as' => 'facebook.showServiceAlbumPictures']);
    Route::post('/social/integrate/facebook/import_pictures', [ 'uses' => 'IntegrationController@importPictures', 'as' => 'facebook.importPictures']);

    // Google

    Route::get('/social/integrate/googledrive/', [ 'uses' => 'IntegrationController@showServiceAlbums', 'as' => 'google.showServiceAlbums', 'middleware' => 'google']);




    // Notification
    //----------------------
    Route::get('/social/integrate/success', 'NotifyController@importSuccess');


    // Storage
    //----------------------
    Route::get('/storage/files', 'StorageController@files');

});


