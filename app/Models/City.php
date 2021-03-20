<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	public function areas(){
		return $this->hasMany('App\Models\CityArea','city_id','id')->whereNull('city_areas.deleted_at');
	}

	 public function gettitleNameAttribute(){
          if(app()->getLocale() == 'bn')
             return $this->title_bn;
          return $this->title;
     }

    public function gettitleValueAttribute(){
             return $this->title;
     }
}
