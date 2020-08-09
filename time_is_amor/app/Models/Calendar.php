<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calendar extends Model
{
  // 各月日付表示
  public function daysInMonth(){ //各月の日数取得
    $dt = new Carbon;
    $daysInMonth = $dt->daysInMonth;
    return $daysInMonth;
  }
  public function days($year, $month){ //先月の日付の箇所を空欄にするため
    $dt = new Carbon;
    $weekDays = $dt->createFromDate($year, $month, 1)->dayOfWeek;
    $NumMonday = 1;
    $days = $NumMonday - $weekDays;
    return $days;
  }

  // 前月表示
  public function subMonth($year, $month) {
    $dt = new Carbon;
    $sub = $dt->createFromDate($year, $month);
    $subMonth = $sub->subMonth();
    return $subMonth;
  }
  // 翌月表示
  public function addMonth($year, $month) {
    $dt = new Carbon;
    $add = $dt->createFromDate($year, $month);
    $addMonth = $add->addMonth();
    return $addMonth;
  }



}
