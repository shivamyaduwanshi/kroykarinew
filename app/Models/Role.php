<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
   use SoftDeletes;

   public function permissions()
    {
    	return $this->belongsToMany('App\Models\Permission');
    }
    
    public function getRoleNameAttribute($value) {
        return ucfirst($value);
    }
}
