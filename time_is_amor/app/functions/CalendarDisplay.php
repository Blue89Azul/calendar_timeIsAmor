<?php
namespace App\functions;
use Carbon\Carbon;

class CalendarDisplay
{
  // Carbonインスタンス化を変数に代入してから、利用したいなぁ。。。
  // 今度考えないとなぁ。。。

    // 現在時刻の表示
    public function carrentDay() {
      $dt = Carbon::createFromDate();
      $dt->timezone = 'Asia/Tokyo';
      return $dt;
    }

    // 曜日の取得
    public $dayOfWeek = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];

    // 日数の取得
    public function getDaysInMonth() {
      $dt = new Carbon;
      $daysInMonth = $dt->daysInMonth;
      return $daysInMonth;
    }

    // "ついたち"の曜日
    public function getFirstDay() {
      $dt = new Carbon;
      $firstDay = $dt->format('N');
      return $firstDay;
    }

}
