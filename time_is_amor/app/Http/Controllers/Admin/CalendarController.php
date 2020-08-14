<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\InputPlan;
use Carbon\Carbon;

class CalendarController extends Controller
{
  public function formDatas(Request $request) {
    $this->validate($request, InputPlan::$rules);
    $ip = new InputPlan;
    $form = $request->all();
    $ip->fill($form)->save();
    return redirect('admin/calendar');
  }

  public function display(Request $request){
    // 初期表示
    $dt = Carbon::createFromDate();
    $year = $request->year;
    $month = $request->month;
    if($year == null || $month == null){
      $year = $dt->year;
      $month =$dt->month;
    }
    // DB全データ取得
    $assignTablePlan = DB::table('input_plans');
    if(isset($assignTablePlan)) {
      $datas = $assignTablePlan->get();
    }
    // 予定記入画面
    $beforeY = $year - 10;
    $afterY = $year + 10;
    $day = $dt->day;
    $hour = $dt->hour;
    $minute = $dt->minute;
    // その他処理記述
    $cal = new Calendar;
    $days = $cal->days($year, $month);   // 各月日付表示
    $daysInMonth = $cal->daysInMonth();
    $subMonth = $cal->subMonth($year, $month);    // 前月表示
    $subY = $subMonth->year;
    $subM = $subMonth->month;
    $addMonth = $cal->addMonth($year, $month);    // 翌月表示
    $addY = $addMonth->year;
    $addM = $addMonth->month;
    return view('admin.calendar', [
      "datas" => $datas,
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
