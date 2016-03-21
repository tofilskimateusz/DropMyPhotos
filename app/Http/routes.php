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
    Route::get('/', 'HomeController@index');
    Route::get('/login', 'Auth\LoginController@form');
    Route::get('/login/fb-callback', 'Social\FacebookController@LoginCallback');


    //Integration Part
    Route::get('/social/integrate/facebook/show_albums', 'IntegrationController@showAlbums');
    Route::get('/social/integrate/facebook/show_albums/{album_id}', 'IntegrationController@showAlbumPictures');
});
