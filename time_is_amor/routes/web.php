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


  Route::get('/calendar/{user_id}', 'CalendarController@showCale'); //FIX
  Route::post('/planList', 'CalendarController@planList_ajax'); //FIX
  Route::post('/calendar/addPlan', 'CalendarController@addPlan');
  Route::post('/calendar/comentList', 'CalendarController@comentList');
  Route::post('/calendar/update', 'CalendarController@profileUpDate'); //FIX
  Route::post('/calendar/invitation', 'CalendarController@invitation');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
