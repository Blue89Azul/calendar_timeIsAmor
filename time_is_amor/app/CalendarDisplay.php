<?php
namespace App;
use Carbon\Carbon;

class CalendarDisplay
{
    private $dt = Carbon::now();
    displayCalendar($dt);

    public function calendarDisplay($dt) {
      $dt->timezone = 'Asia/Tokyo';

    }
}
