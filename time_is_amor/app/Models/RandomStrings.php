<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Users;

class RandomStrings extends Model
{
  protected $guarded = array('id');

  public function users()
  {
      return $this->belongsTo('App\Models\Users');
  }
}
