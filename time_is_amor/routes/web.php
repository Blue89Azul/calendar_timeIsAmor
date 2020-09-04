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


  Route::get('/calendar', 'CalendarController@showCale');
  Route::post('/planList', 'CalendarController@showCale');
  Route::post('/calendar/addPlan', 'CalendarController@addPlan');
  Route::post('/calendar/comentList', 'CalendarController@comentList');



Route::get('/', function () {
    return view('welcome');
});
