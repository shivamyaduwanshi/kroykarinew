<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityArea extends Model
{
	 protected $table = 'city_areas';

	  public function gettitleNameAttribute(){
          if(app()->getLocale() == 'bn')
             return $this->title_bn;
          return $this->title;
     }

    public function gettitleValueAttribute(){
             return $this->title;
     }
}
