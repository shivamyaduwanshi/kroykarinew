<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\City;
use App\Models\CityArea;
use App\User;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{

     public function category(){
     	try {
	     $data = Category::whereNull('parent_id')->orderBy('title','asc')->whereNull('deleted_at')->get();
          if($data->toArray()){
               foreach ($data as $key => $value) {
                    $data[$key]->title       = $value->title_name;
                    $data[$key]->title_name  = $value->title_name;
                    $data[$key]->title_value = $value->title_value;
                    $data[$key]->title = app()->getLocale() == 'bn' ? $value->title_bn : $value->title;
               }
          }
	     return ['status'=>'success','message'=>"success",'data'=>$data];
     	} catch ( \Exception $e) {
     	 return ['status'=>'failed','message'=>__('Something went wrong')];
     	}
     }

     public function subCategory($id){
     	try {
	     $data = Category::find($id)->subCategories()->orderBy('title','asc')->whereNull('deleted_at')->get();
          if($data->toArray()){
               foreach ($data as $key => $value) {
                    $data[$key]->title       = $value->title_name;
                    $data[$key]->title_name  = $value->title_name;
                    $data[$key]->title_value = $value->title_value;
                    $data[$key]->title = app()->getLocale() == 'bn' ? $value->title_bn : $value->title;
               }
          }
          
	     return ['status'=>'success','message'=>"success",'data'=>$data];
     	} catch ( \Exception $e) {
     	 return ['status'=>'failed','message'=>__('Something went wrong')];
     	}
     }

     public function city(){
     	try {
	     $data1 = City::orderBy('title','asc')->where('type','city')->whereNull('deleted_at')->get();
          if($data1->toArray()){
               foreach ($data1 as $key => $value) {
                    $data1[$key]->title_name  = $value->title_name;
                    $data1[$key]->title_value = $value->title_value;
                    $data1[$key]->title = app()->getLocale() == 'bn' ? $value->title_bn : $value->title;
               }
          }
          $data2 = City::orderBy('title','asc')->where('type','division')->whereNull('deleted_at')->get();
          if($data2->toArray()){
               foreach ($data2 as $key => $value) {
                    $data2[$key]->title_name  = $value->title_name;
                    $data2[$key]->title_value = $value->title_value;
                    $data2[$key]->title = app()->getLocale() == 'bn' ? $value->title_bn : $value->title;
               }
          }
          $data = array_merge($data1->toarray(),$data2->toarray());
	     return ['status'=>'success','message'=>"success",'data'=>$data];
     	} catch ( \Exception $e) {
     	 return ['status'=>'failed','message'=> $e->getMessage()];
     	}
     }

     public function cityArea($id){
     	try {
	     $data = City::find($id)->areas()->orderBy('title','asc')->whereNull('deleted_at')->get();
          if($data->toArray()){
               foreach ($data as $key => $value) {
                    $data[$key]->title_name  = $value->title_name;
                    $data[$key]->title_value = $value->title_value;
                    $data[$key]->title = app()->getLocale() == 'bn' ? $value->title_bn : $value->title;
               }
          }
	     return ['status'=>'success','message'=>"success",'data'=>$data];
     	} catch ( \Exception $e) {
     	 return ['status'=>'failed','message'=>__('Something went wrong')];
     	}
     }

     public function login(Request $request){
         
           $input = $request->all();
                  
           $rules = [
              'email'       => 'required',
              'password'    => 'required' 
           ];

          // Validate 
          $validator = \Validator::make($request->all(), $rules);
          if($validator->fails()){
               return array('status' => 'error' , 'msg' => __('failed to login'), '' , 'errors' => $validator->errors());
          }

         if(!auth()->guard()->attempt(array( 'email' => trim($input['email']) , 'password' => trim($input['password'])))) {
               return response(['status' => 'failed' , 'message' => __('Invalid Credientials') ]);       
         }
            $User = User::find(auth::id());
            $User->device_token = $request->device_token ?? NULL;
            $User->device_type  = 'web';
            $User->update();

            return response(['status' => 'success' , 'message' => __('Successfully Logged In') ]);
     }

      public function unreadMessageCount(){
        return \DB::table('chats')->where('receiver_id',auth::id())->where('is_read','0')->count();
      }
    
      public function readMessage(){
        return \DB::table('chats')->where('receiver_id',auth::id())->where('is_read','0')->count();
      }
}
