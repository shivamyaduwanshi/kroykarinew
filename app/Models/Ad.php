<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Like;
use auth;

class Ad extends Model
{
     use SoftDeletes;

     public function user(){
       return $this->hasOne('App\User','id','user_id');
     }

     public function category(){
       return $this->hasOne('App\Models\Category','id','category_id');
     }

     public function subCategory(){
       return $this->hasOne('App\Models\Category','parent_id','category_id');
     }

     public function city(){
       return $this->hasOne('App\Models\City','id','city_id');
     }

     public function area(){
       return $this->hasOne('App\Models\CityArea','id','city_area_id');
     }

     public function getIsLikeAttribute(){
       $count = 0;
       if(auth::check())
          $count = Like::where('user_id',auth::id())->where('ad_id',$this->id)->count();
       return $count  > 0 ? '1' : '0';
     }

    public function getImageAttribute()
    {
        $image = \DB::table('ad_images')->where('ad_id',$this->id)->first(); 
        if($image && file_exists(public_path('images/ad/'.$image->name)))
            return asset('public/images/ad/'.$image->name);
        else
            return false;
    }

    public function getImagesAttribute(){
          $images = \DB::table('ad_images')->where('ad_id',$this->id)->get();
          $imgs   = array(); 
          if($images->toArray()){
              foreach ($images as $key => $img) {
                  array_push($imgs,[ 'id' => $img->id ,'image' => $img->name , 'image_url' =>  asset('public/images/ad/'.$img->name)  , 'name' => asset('public/images/ad/'.$img->name)]);
              }
          }
          return $imgs;
    }

    public function adImages(){
       return $this->hasMany('App\Models\AdImage','ad_id','id');
    }

    public function deleteImages(){
        if($this->images){
          foreach($this->images as $key => $value){
              \File::delete(public_path('images/ad/'.$value['image']));
          }
        }
    }


}
