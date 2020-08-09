<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar;
use Carbon\Carbon;

class CalendarController extends Controller
{
  public function display(Request $request){
    // 初期表示
    $dt = Carbon::createFromDate();
    $year = $request->year;
    $month = $request->month;
    if($year == null || $month == null){
      $year = $dt->year;
      $month =$dt->month;
    }

// 予定記入画面
    //yearOption
    $year = $dt->year;
    $beforeY = $year - 10;
    $afterY = $year + 10;
    // monthOption($monthを使用)
    // dayOption
    $day = $dt->day;
    // hourOption
    $hour = $dt->hour;
    // minuteOption
    $minute = $dt->minute;

    // その他処理記述
    $cal = new Calendar;
    // 各月日付表示
    $days = $cal->days($year, $month);
    $daysInMonth = $cal->daysInMonth();
    // 前月表示
    $subMonth = $cal->subMonth($year, $month);
    $subY = $subMonth->year;
    $subM = $subMonth->month;
    // 翌月表示
    $addMonth = $cal->addMonth($year, $month);
    $addY = $addMonth->year;
    $addM = $addMonth->month;

    return view('admin.calendar', [
      "dt" => $dt,
      "year" => $year,
      "beforeY" => $beforeY,
      "afterY" => $afterY,
      "month" => $month,
      "days" => $days,
      "day" => $day,
      "hour" => $hour,
      "minute" => $minute,
      "daysInMonth" => $daysInMonth,
      "subY" => $subY,
      "subM" => $subM,
      "addY" => $addY,
      "addM" => $addM,
  ]);
  }

}
