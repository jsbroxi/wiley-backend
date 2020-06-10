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
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::get('hotel/list', 'HotelController@getHotelList');
Route::post('hotel/checkavailabilty', 'CalendarController@searchAvailability');

Route::group(['middleware' => 'auth:api'], function()
{
    Route::post('logout', 'UserController@logout');
    Route::post('booking/createbooking', 'BookingController@createBooking');
    Route::post('booking/checkin', 'BookingController@checkIn');
    Route::post('booking/checkout', 'BookingController@checkOut');
    Route::post('booking/bookspa', 'BookingController@orderSpa');
    Route::post('booking/bookfood', 'BookingController@orderFood');
    Route::post('booking/booktaxi', 'BookingController@orderTaxi');
    Route::post('booking/delete', 'BookingController@deleteBooking');
    Route::post('booking/bookpool', 'BookingController@orderPool');
    Route::get('booking/getbookinglist', 'BookingController@getBookingsByUser');
});
