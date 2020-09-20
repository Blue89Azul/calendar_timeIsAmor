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


  Route::get('/calendar/{cal_id}', 'CalendarController@show');
  Route::post('/planList', 'CalendarController@planListAjax');
  Route::post('/calendar/addPlan', 'CalendarController@addPlan');
  Route::post('/calendar/comentList', 'CalendarController@comentList');
  Route::post('/calendar/update', 'CalendarController@profileUpdate');

  //ユーザ招待時のアクション集
  Route::post('/calendar/invitation', 'InvitationController@mail'); //エラーが出そうな予感。。。

  Route::get('/invitation/register/{user_id}', 'InvitationController@getRegister');
  Route::post('/invitation/register/{user_id}', 'InvitationController@postRegister');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
