<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::delete('/delete-hotel', 'HotelController@destroy');
Route::post('/add-hotel', '\HotelController@addHotel')->name('addHotel');
Route::get('/all-hotels', 'HotelController@allHotels')->name('allHotels');
Route::get('/hotel', 'HotelController@getHotel')->name('getHotel');
Route::post("/change-hotel/{id}","HotelController@changeHotel");