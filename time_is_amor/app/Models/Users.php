<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  public function comentlists(){
    return $this->hasMany('App\Models\ComentList');
  }
  public function addplans(){
    return $this->hasMany('App\Models\AddPlan');
  }
}
