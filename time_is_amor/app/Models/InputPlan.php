<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InputPlan extends Model
{
    protected $guarded =['id'];
    public static $rules = array(
      'planTitle' => 'required',
      'startY', 'startM', 'startD', 'startH', 'startMinu','endY', 'endM', 'endD', 'endH', 'endMinu'
    );

}
