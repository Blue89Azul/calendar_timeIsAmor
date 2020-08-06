<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\functions\CalendarDisplay;
use Carbon\Carbon;

class CalendarController extends Controller
{
  public function display(){
    $cal = new CalendarDisplay;
    $calDisplay = $cal->showCalendar();
    return view('admin.calendar', ["cal" => $calDisplay]);
  }
}
