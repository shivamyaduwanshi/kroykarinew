<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
   use SoftDeletes;

     /**
     * Get the permission record associated with the module.
     */
    
    public function permissions()
    {
    	return $this->hasMany('App\Models\Permission');
    }

}
