<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getProfileImageAttribute($image){
        if($image)
             return asset('images/profile/'.$image);
        else
             return asset('backend/images/user-default-image.png');
    }

    public function ads(){
        return $this->hasMany('App\Models\Ad','user_id','id');
    }

    public function canPost($categoryId,$userId = null){
        

        if(is_null($userId)){
            $userId = $this->id;
        }
       
        $count = \DB::table('ads')->whereMonth('created_at',date('m'))->where('user_id',$userId)->whereNull('deleted_at')->count();
       
        if($count >= 3){
            return false;
        }else{
            return true;
        }

        $category = \App\Models\Category::select('posting_allowance')->where('id',$categoryId)->first();
        if($category){
                if($count < $category->posting_allowance){
                    return true;
                }
        }
        return false;
    }

}
