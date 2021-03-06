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
Route::group(['middleware' => ['web']], function() {
    $ids = [];

    Route::get('/', [
        "uses" => "TestController@getPosts",
        "as" => "getpost"
    ]);

    Route::post('/postmessage', [
        "uses" => "TestController@postComment",
        "as" => "postmessage",
    ]);

});
