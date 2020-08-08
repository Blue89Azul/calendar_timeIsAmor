<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar;
use Carbon\Carbon;

class CalendarController extends Controller
{
  public function display(Request $request){
    $cal = new Calendar;
    // 各月日付表示
    $days = $cal->days($request->year, $request->month);
    $daysInMonth = $cal->daysInMonth();

    // 前月表示
    $subMonth = $cal->subMonth($request->year, $request->month);
    $subY = $subMonth->year;
    $subM = $subMonth->month;
    // 翌月表示
    $addMonth = $cal->addMonth($request->year, $request->month);
    $addY = $addMonth->year;
    $addM = $addMonth->month;

    return view('admin.calendar', [
      "days" => $days,
      "year" => $request->year,
      "month" => $request->month,
      "daysInMonth" => $daysInMonth,
      "subY" => $subY,
      "subM" => $subM,
      "addY" => $addY,
      "addM" => $addM,
  ]);
  }

}
