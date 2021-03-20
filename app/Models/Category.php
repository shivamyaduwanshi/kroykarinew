<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ad;

class Category extends Model
{
     use SoftDeletes;

     public function ads(){
       return $this->hasMany('App\Models\Ad','category_id','id');
     }

     public function subCategories(){
       return $this->hasMany('App\Models\Category','parent_id','id');
     }

     public function getImageAttribute($image){
       if($image)
       	    return asset('images/category/'.$image);
       else
            return false;
     }

     public function totalAd($request = array()){

          $search = $request['search'] ?? NULl;
          $cat    = $request['cat']    ?? NULl;
          $city   = $request['city']   ?? NULl;
          $area   = $request['area']   ?? NULl;
          $min    = $request['min']    ?? NULl;
          $max    = $request['max']    ?? NULl;

          return Ad::where('category_id',$this->id)
                    ->join('categories','ads.category_id','=','categories.id')
                    ->join('cities','ads.city_id','=','cities.id')
                    ->join('city_areas','ads.city_area_id','=','city_areas.id')
                    ->join('users as seller','ads.user_id','=','seller.id')
                    ->where('ads.is_publish','1')
                    ->where('ads.is_approved','1')
                    ->where('ads.is_active','1')
                    ->whereNull('ads.deleted_at')
                    ->where('seller.is_active','1')
                    ->whereNull('seller.deleted_at')
                    ->where(function($query) use ($search,$cat,$city,$area,$min,$max){
                        
                         if($search)
                           $query->whereRaw('LOWER(ads.title) like ?', '%'.strtolower(trim($search)).'%');

                          if($city)
                              $query->whereRaw('LOWER(cities.title) like ?', '%'.strtolower(trim($city)).'%');

                          if($area)
                              $query->whereRaw('LOWER(city_areas.title) like ?', '%'.strtolower(trim($area)).'%');

                          if($min)
                              $query->where('ads.price','<=',$min);
                              
                          if($max)    
                              $query->where('ads.price','>=',$max);
                    })
                    ->count();
     }

     public function getTitleNameAttribute(){
          if(app()->getLocale() == 'bn'){
             return $this->title_bn;
          }
          return $this->title;
     }

    public function getTitleValueAttribute(){
             return $this->title;
     }

     public function fields(){
          return $this->hasMany('App\Models\CategoryField','category_id','id');
     }

}
