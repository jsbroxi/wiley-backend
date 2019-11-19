<?php

use Illuminate\Http\Request;

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

header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function()
{
    Route::post('clothslist', 'ClothsController@getList');
    Route::post('logout', 'UserController@logout');
    Route::post('clothbyId/{id}', 'ClothsController@getById');
    Route::post('clothsadd', 'ClothsController@addCloths');
    Route::post('clothesdelete/{id}', 'ClothsController@deleteCloth');
    Route::post('clothesupdate/{id}', 'ClothsController@updateCloth');
});
