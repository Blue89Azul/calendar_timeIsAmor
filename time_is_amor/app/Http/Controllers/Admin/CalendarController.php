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
    $year = $instCarbon->year;
    $month = $instCarbon->month;

    // CalendarModel群（処理記述はこっち）
    $cal = new Calendar;
    $days = $cal->days();
    $subMonth = $cal->subMonth();
    

    $addMonth = $cal->addMonth();

    return view('admin.calendar', [
      "days" => $days,
      "daysInMonth" => $daysInMonth,
      "year" => $year,
      "month" => $month,
  ]);
  }

}
