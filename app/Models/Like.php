<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
  public function ad(){
  	return $this->hasOne('App\Models\Ad','id','ad_id');
  }

  public function user(){
  	return $this->hasOne('App\User','id','user_id');
  }
}
