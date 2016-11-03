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

$domain = 'localhost';
if (App::environment() == 'live')
{
    $domain = 'javdb.com';
}

/* Front-end ****************************************************************************************/

Route::group(['domain' => $domain], function (){

    Route::get('/', 'FeHomeController@index');
    Route::get('/home', 'FeHomeController@index');
    /*Movie*/
    Route::get('/movies', 'FeMoviesController@index');
    Route::get('/movies/list', 'FeMoviesController@index');
    Route::get('/movies/{code}', 'FeMoviesController@show');
    /*Actress*/
    Route::get('/actresses', 'FeActressesController@index');
    Route::get('/actresses/list', 'FeActressesController@index');
    Route::get('/actresses/{name}', 'FeActressesController@show');

    /*404*/
    Route::get('errors/404',['as' => '404',  function (){
        return view('frontend.errors.404');
    }]);
    /*test*/
    Route::get('/test', 'TestController@get');
    Route::post('/test', 'TestController@post');
});

/* Back-end ****************************************************************************************/

Route::group(['middleware' => 'web', 'domain' => 'admin.'.$domain ], function () {

    Route::auth();
    Route::get('/', 'AdminController@index');
});

Route::group(['middleware' => ['auth'], 'domain' => 'admin.'.$domain ], function (){

    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/dashboard', 'HomeController@index');

    Route::resource('studios', 'StudiosController');
    Route::resource('series', 'SeriesController');
    Route::resource('tags', 'TagsController');
    Route::resource('actresses', 'ActressesController');
    Route::resource('movies', 'MoviesController');
});

//remove cast
Route::group(['middleware' => ['auth'], 'domain' => 'admin.'.$domain], function (){
	Route::post('/actresses/{actressID}/remove/{movieID}', 'ActressesController@castout');
	Route::post('/movies/{movieID}/remove/{actressID}', 'MoviesController@castout');
});

/* Common ******************************************************************************************/

//Image
Route::get('/image', 'ImagesController@image');