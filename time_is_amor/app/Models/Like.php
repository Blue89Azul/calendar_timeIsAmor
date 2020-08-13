<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $guarded = ['id'];
    public static $rules = ['plan_id', 'likeA', 'likeB', 'likeC'];
    public function plan(){
      return $this->belongsTo(InputPlan::class);
    }
}
