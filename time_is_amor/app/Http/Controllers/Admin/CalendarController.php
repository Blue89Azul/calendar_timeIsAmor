<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\functions\CalendarDisplay;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function display() {
      $instance = new CalendarDisplay;
      $carrentDay = $instance->carrentDay();
      $dayOfWeek = $instance->dayOfWeek;
      $daysInMonth = $instance->getDaysInMonth();
      $firstDay = $instance->getFirstDay();

      return view('admin.calendar', [
        'carrentDay' => $carrentDay,
        'dayOfWeek' => $dayOfWeek,
        'daysInMonth' => $daysInMonth,
        'firstDay' => $firstDay;
      ]);

    }


}
