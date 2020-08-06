<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar;
use Carbon\Carbon;

class CalendarController extends Controller
{
  public function display(){
    // Carbonメソッド群
    $instCarbon = new Carbon;
    $daysInMonth = $instCarbon->daysInMonth;

    // CalendarModel群（処理記述はこっち）
    $cal = new Calendar;
    $firstWeekDay = $cal->firstWeekDay();

    return view('admin.calendar', [
    "firstWeekDay" => $firstWeekDay,
    "daysInMonth" => $daysInMonth,
  ]);
  }

}
