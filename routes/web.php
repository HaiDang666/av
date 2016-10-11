<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {

    Route::auth();
});

Route::group(['middleware' => ['auth']], function (){

    Route::get('/dashboard', 'HomeController@index');

    Route::resource('studios', 'StudiosController');
    Route::resource('tags', 'TagsController');
    Route::resource('actresses', 'ActressesController');
    Route::resource('movies', 'MoviesController');
});

//Image
Route::get('/image', 'ImagesController@image');

//remove cast
Route::group(['middleware' => ['auth']], function (){
	Route::post('/actresses/{actressID}/remove/{movieID}', 'ActressesController@castout');
	Route::post('/movies/{movieID}/remove/{actressID}', 'MoviesController@castout');
});

Route::group(['middleware' => ['auth']], function (){

    Route::get('/test', 'TestController@get');

    Route::post('/test', 'TestController@post');
});