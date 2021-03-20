<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryField extends Model
{
    use SoftDeletes;

    protected $table = 'category_field';

    public function field(){
        return $this->hasOne('App\Models\Field','id','field_id');
   }
}
