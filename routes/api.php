<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
    return ['status' => 'OK'];
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
});

Route::post('users', 'UserController@store');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('users', 'UserController@index');
    Route::get('users/{id}', 'UserController@show');
    Route::put('users/{id}', 'UserController@update');

    Route::resource('messages', 'MessageController');

    Route::post('messages/{message_id}/replies', 'ReplyController@store');
    Route::get('messages/{message_id}/replies', 'ReplyController@index');
    Route::get('/replies/{id}', 'ReplyController@show');
    Route::put('/replies/{id}', 'ReplyController@update');
    Route::delete('/replies/{id}', 'ReplyController@destroy');
});
