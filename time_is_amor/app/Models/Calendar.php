<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calendar extends Model
{
  // ついたちの曜日を取得
  public function firstWeekDay(){
    $dt = new Carbon;
    $year = $dt->year;
    $month = $dt->month;
    $firstWeekDay = $dt->createFromDate($year, $month, 1)->dayOfWeekIso;
    return $firstWeekDay;
  }


}
