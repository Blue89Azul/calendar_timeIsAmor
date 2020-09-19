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

// カレンダーIDの値をURLに挿入。


  Route::get('/calendar', 'CalendarController@show');

  Route::post('/planList', 'CalendarController@planListAjax');
  Route::post('/calendar/addPlan', 'CalendarController@addPlan');
  Route::post('/calendar/comentList', 'CalendarController@comentList');
  Route::post('/calendar/update', 'CalendarController@profileUpdate');
  Route::post('/calendar/invitation', 'CalendarController@invitation');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
