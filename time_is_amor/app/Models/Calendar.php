<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calendar extends Model
{
  //先月の日付の箇所を空欄にするため
  public function days(){
    $dt = new Carbon;
    $year = $dt->year;
    $month = $dt->month;
    $weekDays = $dt->createFromDate($year, $month, 1)->dayOfWeekIso;
    $NumMonday = 1;
    $days = $NumMonday - $weekDays;
    return $days;
  }

  // 表示月変更処理（１ヶ月前）
  public function subMonth() {
    $dt = new Carbon;
    $year = $dt->year;
    $month = $dt->month;
    $day = $dt->day;
    $sub = $dt->createFromDate($year, $month, $day);
    $subMonth = $sub->subMonth();
    return $subMonth;
  }

  // 表示月変更処理（１ヶ月後）
  public function addMonth() {
    $dt = new Carbon;
    $year = $dt->year;
    $month = $dt->month;
    $day = $dt->day;
    $add = $dt->createFromDate($year, $month, $day);
    $addMonth = $sub->addMonth();
    return $addMonth;
  }


}
