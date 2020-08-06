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
    $firstWeekDay = $dt->createFromDate($year, $month,1)->dayOfWeekIso;

  }
}
