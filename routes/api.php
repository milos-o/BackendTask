<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::delete('/delete-hotel', 'App\Http\Controllers\HotelController@destroy');
Route::post('/add-hotel', 'App\Http\Controllers\HotelController@addHotel')->name('addHotel');
Route::get('/all-hotels', 'App\Http\Controllers\HotelController@allHotels')->name('allHotels');
Route::get('/hotel', 'App\Http\Controllers\HotelController@getHotel')->name('getHotel');
Route::get('/hotel-rated/{rating}', 'App\Http\Controllers\HotelController@getRatedHotel');
Route::get('/hotel-located/{location}', 'App\Http\Controllers\HotelController@getHotelInLocation');
Route::get('/hotel-badge/{badge}', 'App\Http\Controllers\HotelController@getHotelsWithReputationBadge');
Route::get('/hotel-category/{category}', 'App\Http\Controllers\HotelController@getHotelsWithCategory');
Route::get('/hotel-availability/{availability}', 'App\Http\Controllers\HotelController@getHotelsWithAvailability');


Route::post("/change-hotel/{id}","App\Http\Controllers\HotelController@changeHotel");

Route::delete('/delete-location', 'App\Http\Controllers\LocationController@destroy');
Route::post('/add-location', 'App\Http\Controllers\LocationController@addLocation');
Route::get('/all-locations', 'App\Http\Controllers\LocationController@allLocations');
Route::get('/location', 'App\Http\Controllers\LocationController@getLocation');
Route::post("/change-location/{id}","App\Http\Controllers\LocationController@changeLocation");