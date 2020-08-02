<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalendarModel;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function displayCalendar() {
      $calDisplay = new CalendarDisplay;

      return view('admin.calendar');
    }
}
