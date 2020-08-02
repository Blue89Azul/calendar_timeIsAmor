<?php
namespace App\functions;
use Carbon\Carbon;

class CalendarDisplay
{

    public function carrentDay() {
      $dt = Carbon::createFromDate();

      // 現在時刻の表示
      $dt->timezone = 'Asia/Tokyo';
      return $dt;

      // 曜日の出力
      $dayOfWeek = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
      return $dayOfWeek;
    }
}
