<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
  // $user_id = ;
  // Route::get('/calendar/{id}', function($id = $user_id){
  // return view('calendar');
  // });
  Route::get('/calendar', 'CalendarController@show');


  Route::post('/planList', 'CalendarController@planListAjax');
  Route::post('/calendar/addPlan', 'CalendarController@addPlan');
  Route::post('/calendar/comentList', 'CalendarController@comentList');
  Route::post('/calendar/update', 'CalendarController@profileUpdate');

  //ユーザ招待時のアクション集
  Route::post('/calendar/invitation', 'InvitationController@mail'); //エラーが出そうな予感。。。

  Route::get('/invitation/register/{id}', 'InvitationController@getRegister');
  Route::post('/invitation/register/{id}', 'InvitationController@postRegister');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
