<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InputPlan extends Model
{
    protected $guarded =['id'];
    public static $rules = array(
      'planTitle' => 'required','likeCheck',
      'startY', 'startM', 'startD', 'startH', 'startMinu',
      'endY', 'endM', 'endD', 'endH', 'endMinu',
    );

    public function likes() {
      return $this->hasMany(Like::class, 'plan_id', 'id');
    }

}
