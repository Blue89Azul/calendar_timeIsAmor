<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calendar extends Model
{
  public function weekDays(){
    $dt = new Carbon;
    $year = $dt->year;
    $month = $dt->month;
    $weekDays = $dt->createFromDate($year, $month, 1)->dayOfWeekIso;

    $NumMonday = 1;
    $day = $NumMonday - $weekDays;
    return $day;
  }


}
