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
      $calCarrentDay = $instance->carrentDay();
      $dayOfWeek = $calCarrentDay->dayOfWeek;

      return view('admin.calendar', [
        'CarrentDay' => $calCarrentDay,
        'dayOfWeek' => $dayOfWeek,
      ]);

    }


}
