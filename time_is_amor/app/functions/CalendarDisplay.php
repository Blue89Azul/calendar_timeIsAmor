<?php
namespace App\functions;
use Carbon\Carbon;

class CalendarDisplay
{
  public function showCalendar(){
    $dt = new Carbon;
    $year = $dt->year;
    $month = $dt->month;
    // ついたちの曜日を取得
    $firstWeekDay = $dt->createFromDate($year, $month, 1)->dayOfWeekIso;
    // 日数を取得
    $daysInMonth = $dt->daysInMonth;
    $days = 1 - $firstWeekDay;
  }
}
