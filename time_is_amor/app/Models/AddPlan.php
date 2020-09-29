<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class AddPlan extends Model
{
    protected $guarded = array('id');
    public static $rules = array(
      'startDate'=>'required',
      'endDate'=>'required',
      'planTitle'=>'required',
      'color'=>'required',
    );

    // リレーション
}
