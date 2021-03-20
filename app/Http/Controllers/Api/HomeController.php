<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use App\Helpers\ImageHelper;
use App\Helpers\NotificationHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryField;
use Response;
use DB;
use App\Models\Chat;
use App\Mail\NotifyMail;
use Mail;
use App\Models\Ad;
use App;

class HomeController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
     public function __construct(Request $request){
         if($request->lang){
             App::setlocale($request->lang);
         }
     }

     public function getCategories(){
         $categories = Category::whereNull('parent_id')->where('is_active','1')->whereNull('deleted_at')->get();
         $data = array();
         if($categories->toArray()){
            foreach ($categories as $key => $category) {
              $temp = [];
              $temp['category_id'] = $category->id ?? '';
              $temp['title']       = $category->title_name ?? '';
              $temp['image']       = $category->image ?? '';
              array_push($data,$temp);
            }
         return ['status' => true,'message'=> __('Record found'),'data'=>$data];
         }
        return ['status' => false ,'message'=> __('Record not found')];
     }

     public function home(Request $request){
          
         $categoriesData = Category::whereNull('parent_id')->where('is_active','1')->whereNull('deleted_at')->get();
         $categories  = array();
         if($categoriesData->toArray()){
            foreach ($categoriesData as $key => $category) {
              $temp = [];
              $temp['category_id'] = $category->id ?? '';
              $temp['title']       = $category->title_name ?? '';
              $temp['image']       = $category->image ?? '';
              array_push($categories,$temp);
             }
         }
        
         $adsData = Ad::select('ads.*')->join('users','ads.user_id','=','users.id')
                    ->where('ads.is_active','1')
                    ->where('ads.is_publish','1')
                    ->where('ads.is_approved','1')
                    ->where('users.is_active','1')
                    ->whereNull('ads.deleted_at')
                    ->whereNull('users.deleted_at')
                    ->get();
         $ads = array();
         if($adsData->toArray()){
            foreach ($adsData as $key => $ad) {
              $temp = [];
              $temp['ad_id']  = $ad->id;
              $temp['title']  = $ad->title;
              $temp['is_featured']  = $ad->is_featured;
              $temp['image']  = $ad->image;
              $temp['price']  = $ad->price;
              $temp['category']  = $ad->category->title_name ?? '';
              $temp['sub_category']  = $ad->subcategory->title_name ?? '';
              $isFavourite = 0;
              if($request->user_id || $request->unique_id){
                  $isFavourite = DB::table('favouriate_ads')->where(function($query) use ($request){
                    $query->where('user_id',$request->user_id);
                    $query->orWhere('unique_id',$request->unique_id);
                  })->where('ad_id',$ad->id)->count();
                  $isFavourite = $isFavourite > 0 ? '1' : '0';
              }
              $temp['is_favouriate'] = $isFavourite;
              $temp['is_sell']       = '1';
              $temp['location'] = $ad->area->title_name ?? '' .' ('.$ad->city->title_name ?? '' .')';
              array_push($ads,$temp);
            }
         }

         $data['categories'] = $categories;
         $data['ads']        = $ads;
        
         return ['status'=>true,'message'=> __('Record not') , 'data' => $data ];
     }
             
     public function getAds(Request $request){
         $adsData = Ad::select('ads.*')
                    ->join('users','ads.user_id','=','users.id')
                    ->join('categories','ads.category_id','=','ads.category_id')
                    ->join('cities','ads.city_id','=','cities.id')
                    ->join('city_areas','ads.city_area_id','=','city_areas.id')
                    ->where('ads.is_active','1')
                    ->where('ads.is_publish','1')
                    ->where('ads.is_approved','1')
                    ->where('users.is_active','1')
                    ->whereNull('ads.deleted_at')
                    ->whereNull('users.deleted_at')
                    ->where(function($query) use ($request){

                       if(!empty($request->seller_id) && !is_null($request->seller_id)){
                          $query->where('ads.user_id',$request->seller_id);
                       }
                       
                       if(!empty($request->user_id) && !is_null($request->category_id)){
                          $query->where('ads.category_id',$request->category_id);
                       }
                       
                       if(!empty($request->user_id) && !is_null($request->sub_category_id)){
                          $query->where('ads.sub_category_id',$request->sub_category_id);
                       }
                       
                       if(!empty($request->user_id) && !is_null($request->city_id)){
                          $query->where('ads.city_id',$request->city_id);
                       }
                       
                       if(!empty($request->user_id) && !is_null($request->area_id)){
                          $query->where('ads.city_area_id',$request->area_id);
                       }
                       
                       if(!empty($request->user_id) && !is_null($request->is_featured)){
                          $query->where('ads.is_featured',$request->is_featured);
                       }

                       if(!empty($request->user_id) && !is_null($request->search)){
                          $query->whereRaw('LOWER(ads.title) like ?', '%'.strtolower(trim($request->search)).'%');
                          $query->orWhereRaw('LOWER(categories.title) like ?', '%'.strtolower(trim($request->search)).'%');
                          $query->orWhereRaw('LOWER(cities.title) like ?', '%'.strtolower(trim($request->search)).'%');
                          $query->orWhereRaw('LOWER(city_areas.title) like ?', '%'.strtolower(trim($request->search)).'%');
                       }
                      
                       if(!empty($request->user_id) && !is_null($request->min)){
                          $query->where('ads.price','<=',$request->min);
                       }

                       if(!empty($request->user_id) && !is_null($request->max)){
                         $query->where('ads.price','>=',$request->max);
                       }

                    })
                    ->groupBy('ads.id')
                    ->get();

         $ads = array();
         if($adsData->toArray()){
            foreach ($adsData as $key => $ad) {
              $temp = [];
              $temp['ad_id']  = $ad->id;
              $temp['title']  = $ad->title;
              $temp['is_featured']  = $ad->is_featured;
              $temp['image']  = $ad->image;
              $temp['price']  = $ad->price;
              $temp['category']  = $ad->category->title_name ?? '';
              $temp['sub_category']  = $ad->subcategory->title_name ?? '';
              $isFavourite = 0;
              if($request->user_id){
                  $isFavourite = DB::table('favouriate_ads')->where('user_id',$request->user_id)->where('ad_id',$ad->id)->count();
                  $isFavourite = $isFavourite > 0 ? '1' : '0';
              }
              $temp['is_favouriate'] = $isFavourite;
              $temp['is_sell']       = '1';
              $temp['location'] = $ad->area->title_name ?? '' .' ('.$ad->city->title_name ?? '' .')';
              array_push($ads,$temp);
            }
           return ['status'=>true,'message'=> __('Record not') , 'data' => $ads ];
         }else{
           return ['status'=>false,'message'=> __('Record not not') ];
         }


     }

     public function getAd(Request $request){
         $inputs         = $request->all();

          $rules = [
                     'ad_id'  => 'required',
                    ];

           $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
             $errors =  $validator->errors()->all();
             return response(['status' => false , 'message' => $errors[0]] , 200);              
         }

         $adData = Ad::select('ads.*')
                    ->join('users','ads.user_id','=','users.id')
                    ->join('categories','ads.category_id','=','ads.category_id')
                    ->join('cities','ads.city_id','=','cities.id')
                    ->join('city_areas','ads.city_area_id','=','city_areas.id')
                    ->where('ads.is_active','1')
                    ->where('ads.is_publish','1')
                    ->where('ads.is_approved','1')
                    ->where('users.is_active','1')
                    ->whereNull('ads.deleted_at')
                    ->whereNull('users.deleted_at')
                    ->where('ads.id',$inputs['ad_id'])
                    ->first();

          $adData = Ad::select('ads.*')
                    ->join('users','ads.user_id','=','users.id')
                    ->join('categories','ads.category_id','=','ads.category_id')
                    ->join('cities','ads.city_id','=','cities.id')
                    ->join('city_areas','ads.city_area_id','=','city_areas.id')
                    ->whereNull('ads.deleted_at')
                    ->whereNull('users.deleted_at')
                    ->where('ads.id',$inputs['ad_id'])
                    ->first();

        if($adData){
              $ad = [];
              $ad['ad_id']        = $adData->id;
              $ad['title']        = $adData->title;
              $ad['description']  = $adData->description;
              $ad['condition_id'] = $adData->condition;
              $ad['condition']    = $adData->condition ? __('New') : __('Used');
              $ad['is_featured']  = $adData->is_featured;
              $ad['images']       = $adData->images;
              $ad['price']        = $adData->price;
              $ad['category_id']      = $adData->category_id;
              $ad['sub_category_id']  = $adData->sub_category_id;
              $ad['category']     = $adData->category->title_name ?? '';
              $ad['sub_category'] = $adData->subcategory->title_name ?? '';
              $ad['brand'] = $adData->brand;
              $isFavourite        = 0;
              if($request->user_id){
                  $isFavourite = DB::table('favouriate_ads')->where('user_id',$request->user_id)->where('ad_id',$adData->id)->count();
                  $isFavourite = $isFavourite > 0 ? '1' : '0';
              }
              $ad['is_favouriate'] = $isFavourite;
              $ad['is_sell']          = '1';
              $ad['city_id']          = $adData->city_id;
              $ad['city_are_id']      = $adData->city_area_id;
              $ad['city_name']        = $adData->city->title_name ?? '';
              $ad['city_are_name']    = $adData->area->title_name ?? '';
              $ad['location']         = $adData->area->title_name ?? '' .' ('.$adData->city->title_name ?? '' .')';
              $ad['ad_date']          = date('Y-m-d H:i:s',strtotime($adData->created_at));
              $ad['seller_id']        = $adData->user_id;
              $ad['seller_name']      = $adData->user->name;
              $ad['seller_profile']   = $adData->user->profile_image;
              $ad['seller_registration_date']   = date('Y-m-d',strtotime($adData->user->created_at));
              $ad['seller_email']     = $adData->user->email;
              $ad['seller_phone']     = $adData->user->phone;

              $ad['is_deliver_to_buyer']  = $adData->is_deliver_to_buyer ?? 0;
              $ad['is_hide_phone_number'] = $adData->is_hide_phone_number ?? 0;
                  $phoneNumbers = array();
                  if($adData->phone_numbers){
                       $phoneNumbers = unserialize($adData->phone_numbers);
                  }
                  
                  $ad['phone_numbers']        = $phoneNumbers;
                  $ad['is_negotiable']        = $adData->adDatavis_negotiable ?? 0;
                  $ad['lat']                  = $adData->lat   ?? NULL;
                  $ad['lng']                  = $adData->lng   ?? NULL;
                  $ad['map_address']          = $adData->map_address ?? NULL;


              $fields = array();
              $categoryFields = CategoryField::leftJoin('ad_values','category_field.field_id','=','ad_values.field_id')->where('category_id', $adData->sub_category_id)->groupBy('category_field.field_id')->get();
              $optionValuesData = \DB::table('ad_values')->where('ad_id',$inputs['ad_id'])->get();
              $optionKeys       = array_column($optionValuesData->toarray(),'field_id');
              $optionValues     = array_column($optionValuesData->toarray(),'value');
              $optionsData      = array_combine($optionKeys,$optionValues);
              if ($categoryFields->toArray()) {
                  foreach ($categoryFields as $key => $value) {

                    $otpsData = $value->field->options ?? array();
                   $options = array();
                    if($otpsData){
                      foreach($otpsData as $optData){
                         array_push($options,[
                           'id'       => $optData->id,
                           'field_id' => $optData->field_id,
                           'option'   => $optData->option,
                           'label'    => __($optData->option)
                         ]);
                      }
                    }

                      if ($value->field) {
                          array_push($fields, [
                          'category_id' => $value->category_id,
                          'field_id'    => $value->field_id,
                          'field_name'  => __($value->field->name),
                          'field_type'  => $value->field->type,
                          'field_value' => $optionsData[$value->field_id] ?? '',
                          'options'     => $options  ?? array()
                    ]);
                      }
                  }
              }
              $ad['fields'] = $fields;
           return ['status'=>true,'message'=> __('Record found') , 'data' => $ad ];
         }else{
           return ['status'=>false,'message'=> __('Record not not') ];
         }
   
      }

     public function doFavouriteAd(Request $request){
         $inputs         = $request->all();
         $userId     = $request->user_id ?? NUll;
         $uniqueId   = $request->unique_id ?? NULL;
         if(DB::table('favouriate_ads')->insertGetId(['unique_id'=>$uniqueId,'user_id'=>$userId,'ad_id'=>$inputs['ad_id']])){
          if($userId){
              $adData = DB::table('ads')->select('id','user_id','title')->where('id',$inputs['ad_id'])->first();
              $senderData   = User::select('id','name','profile_image')->where('id',$inputs['user_id'])->first();
              $receiverData = User::select('id','device_token','device_type','is_notify')->where('id',$adData->user_id)->first(); 
              $nofifyData   = array();
              array_push($nofifyData,[
                  'title' => 'Like',
                  'body'  => $adData->title . ' liked by ' . $senderData->name,
                  'sender_id'   => $senderData->id,
                  'receiver_id' => $receiverData->id,
                  'id'          => $adData->id,
                  'type'        => 'like',
                  'meta_data'   => ['id'=>$adData->id,'type'=>'like'],
                  'is_notify'   => $receiverData->is_notify,
                  'device_token' => $receiverData->device_token,
                  'device_type'  => $receiverData->device_type,
                  'icon'        => $senderData->profile_image
              ]);
              NotificationHelper::send($nofifyData);
              NotificationHelper::store($nofifyData);
          }
           return ['status' => true,'message'=> __('Success')];
         }
          return ['status'=>true,'message'=>__('Failed')];
     }

     public function removeFavouriteAd(Request $request){
         $inputs     = $request->all();
         $adId       = $request->ad_id;
         $userId     = $request->user_id   ?? NULL;
         $uniqueId   = $request->unique_id ?? NULL;
         DB::table('favouriate_ads')->where('user_id',$userId)->where('ad_id',$adId)->delete();
         DB::table('favouriate_ads')->where('unique_id',$uniqueId)->where('ad_id',$adId)->delete();
         return ['status' => true,'message'=> __('Success')];
     }

     public function getFavouriteAds(Request $request){
         
          $inputs         = $request->all();

         /*  $rules = [
                     'user_id'      => 'required',
                    ];

           $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
             $errors =  $validator->errors()->all();
             return response(['status' => false , 'message' => $errors[0]] , 200);              
         }

         */

        $userId     = $request->user_id ?? NULL;
        $uniqueId   = $request->unique_id ?? NULL;

        $adsData = Ad::select('ads.*')
                    ->join('favouriate_ads','ads.id','=','favouriate_ads.ad_id')
                    ->join('users','ads.user_id','=','users.id')
                    ->where('ads.is_active','1')
                    ->where('ads.is_publish','1')
                    ->where('ads.is_approved','1')
                    ->where('users.is_active','1')
                    ->whereNull('ads.deleted_at')
                    ->where(function($query) use ($userId,$uniqueId){
                      $query->where('favouriate_ads.user_id',$userId);
                      $query->orWhere('favouriate_ads.unique_id',$uniqueId);
                    })
                    ->whereNull('users.deleted_at')
                    ->get();

         $ads = array();
         if($adsData->toArray()){
            foreach ($adsData as $key => $ad) {
              $temp = [];
              $temp['ad_id']  = $ad->id;
              $temp['title']  = $ad->title;
              $temp['is_featured']  = $ad->is_featured;
              $temp['image']  = $ad->image;
              $temp['price']  = $ad->price;
              $temp['category']  = $ad->category->title_name ?? '';
              $temp['sub_category']  = $ad->subcategory->title_name ?? '';
              $isFavourite = 1;
              $temp['is_favouriate'] = $isFavourite;
              $temp['is_sell']       = '1';
              $temp['location'] = $ad->area->title_name ?? '' .' ('.$ad->city->title_name ?? '' .')';
              array_push($ads,$temp);
            }
            return ['status'=>true,'message'=> __('Record not') , 'data' => $ads ];
         }

         return ['status'=>false,'message'=> __('Record not found') ];
     }

     public function randomPassword() {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function getSubCategories(Request $request){
          
          $inputs         = $request->all();

          $rules = [
                     'category_id'      => 'required',
                    ];

           $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
             $errors =  $validator->errors()->all();
             return response(['status' => false , 'message' => $errors[0]] , 200);              
         }

         $categories = Category::where('parent_id',$inputs['category_id'])->where('is_active','1')->whereNull('deleted_at')->orderBy('categories.title','asc')->get();
         $data = array();
         if($categories->toArray()){
            foreach ($categories as $key => $category) {
              $temp = [];
              $temp['sub_category_id'] = $category->id;
              $temp['title']       = $category->title_name ?? '';
              array_push($data,$temp);
            }
         return ['status' => true,'message'=> __('Record found'),'data'=>$data];
         }
        return ['status' => false ,'message'=> __('Record not found')];
    }

    public function adAdd(Request $request){

      
      $input = $request->all();
      $rules = [
          'user_id'           => 'required|numeric',
          'category_id'        => 'required',
          'sub_category_id'    => 'required',
          'city_id'            => 'required',
          'city_area_id'      => 'required',
          'title'              => 'required',
          'description'        => 'required',
          'price'              => 'required',
          'image'              => 'required'
         ];
         
         $validator = Validator::make($request->all(), $rules);


         
         if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
         } 

         $User = User::find($input['user_id']);
         $canPost = $User->canPost($input['category_id'],$input['user_id']);

         if(!$canPost){
           return ['status'=>false,'message'=> __('You riched the maximum limit of post ad') ];
         }
         
         $images = json_decode($input['image']);

         $latitude   = $input['lat'] ?? null;
         $longitude  = $input['lng'] ?? null;
         $mapAddress = null;


         if($latitude && $longitude){
            $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAGQC7r17YyESlAGS8raZ0G1Q-r9Q1s4Vk&latlng='.trim($latitude).','.trim($longitude).'&sensor=false'); 
            $output = json_decode($geocodeFromLatLong);
            $status = $output->status;
            $mapAddress = ($status=="OK")?$output->results[1]->formatted_address:'';
         }
         
       $adData = [
         'category_id'     => $input['category_id'],
         'sub_category_id' => $input['sub_category_id'],
         'title'           => $input['title'],
         'description'     => $input['description'],
         'price'           => $input['price'],
         'city_id'         => $input['city_id'],
         'city_area_id'    => $input['city_area_id'],
         'user_id'         => $input['user_id'],
         'is_deliver_to_buyer'  => $input['is_deliver_to_buyer'] ?? 0,
         'is_hide_phone_number' => $input['is_hide_phone_number'] ?? 0,
         'phone_numbers'        =>  $input['phone_numbers'] ? serialize(explode(',',$input['phone_numbers'])) :  serialize(array()),
         'is_negotiable' => $input['is_negotiable'] ?? 0,
         'lat'                 => $latitude   ?? NULL,
         'lng'                 => $longitude  ?? NULL,
         'map_address'         => $mapAddress ?? NULL 
       ];
       DB::beginTransaction();
       try {
         $imageData = array();
         $adId =  DB::table('ads')->insertGetId($adData);

         foreach($images as $key => $value){
           array_push($imageData, ['ad_id' => $adId,'name' => $value->image]);
         }

        if($request->hasFile('image')){
           foreach ($request->image as $key => $image) {
               $imageName = str_random('10').'.'.time().'.'.$image->getClientOriginalExtension();
               $image->move(public_path('images/ad/'), $imageName);
               array_push($imageData, ['ad_id' => $adId,'name' => $imageName]);
           }
        } 

        $dynamicFieldDataStore = array();
        $formField = json_decode($request->form_field,true);
         if($formField){
           foreach($formField as $key => $value){
             array_push($dynamicFieldDataStore,[
                 'ad_id'     => $adId,
                 'field_id'  => $value['field'],
                 'option_id' => gettype($value['value']) != 'array' ? $value['value'] : null,
                 'value'     => gettype($value['value']) == 'array' ? json_encode($value['value']) : $value['value']
             ]);
         }
       }
       
       if($dynamicFieldDataStore) 
           DB::table('ad_values')->insert($dynamicFieldDataStore);

         if($imageData)
             DB::table('ad_images')->insert($imageData);
         DB::commit();
         return ['status'=> true ,'message'=>__('Successfully added ad')];
       } catch ( \Exception $e) {
         DB::rollback();
           return ['status'=> false ,'message'=> __('Failed to add ad') ];
       }
   }

    public function removeAd(Request $request){
      $input = $request->all();
      $rules = [
          'user_id'     => 'required',
          'ad_id'       => 'required',
       ];
       $validator = Validator::make($request->all(), $rules);
       if ($validator->fails()) {
          $errors =  $validator->errors()->all();
          return response(['status' => false , 'message' => $errors[0]]);              
       }
         $Ad = Ad::find($input['ad_id']);
        try{
          DB::beginTransaction();
          DB::table('ads')->where('id',$input['ad_id'])->delete();
          DB::table('chats')->where('ad_id',$input['ad_id'])->delete();
          DB::table('ad_images')->where('ad_id',$input['ad_id'])->delete();
          DB::table('ad_values')->where('ad_id',$input['ad_id'])->delete();
          DB::table('favouriate_ads')->where('ad_id',$input['ad_id'])->delete();
          DB::table('report_ads')->where('ad_id',$input['ad_id'])->delete();
          DB::commit();
          $Ad->deleteImages();
          return ['status'=> true ,'message'=>__('Successfully deleted ad')];
       }catch(\Exception $e){
          DB::rollback();
          return ['status'=> false ,'message'=>__('Failed to delete ad')];
       }
    }

    public function getMyAds(Request $request){

          $inputs = $request->all();

          $rules = [
                     'user_id' => 'required',
                    ];

           $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
             $errors =  $validator->errors()->all();
             return response(['status' => false , 'message' => $errors[0]] , 200);              
         }

           $adsData = Ad::select('ads.*')
                    ->join('categories','ads.category_id','=','ads.category_id')
                    ->join('cities','ads.city_id','=','cities.id')
                    ->join('city_areas','ads.city_area_id','=','city_areas.id')
                    ->whereNull('ads.deleted_at')
                    ->where('ads.user_id',$inputs['user_id'])
                    ->groupBy('ads.id')
                    ->get();

         $ads = array();
         if($adsData->toArray()){
            foreach ($adsData as $key => $ad) {
              $temp = [];
              $temp['ad_id']  = $ad->id;
              $temp['title']  = $ad->title;
              $temp['is_featured']  = $ad->is_featured;
              $temp['image']  = $ad->image;
              $temp['price']  = $ad->price;
              $temp['category']  = $ad->category->title_name ?? '';
              $temp['sub_category']  = $ad->subcategory->title_name ?? '';
              $isFavourite = 0;
              if($request->user_id){
                  $isFavourite = DB::table('favouriate_ads')->where('user_id',$request->user_id)->where('ad_id',$ad->id)->count();
                  $isFavourite = $isFavourite > 0 ? '1' : '0';
              }
              $temp['is_favouriate'] = $isFavourite;
              $temp['is_sell']       = '1';
              $temp['location'] = $ad->area->title_name ?? '' .' ('.$ad->city->title_name ?? '' .')';
              array_push($ads,$temp);
            }
           return ['status'=>true,'message'=> __('Record not') , 'data' => $ads ];
         }else{
           return ['status'=>false,'message'=> __('Record not not') ];
         }
    }

    public function getAdDetails(Request $request){
          
              $inputs         = $request->all();

              $rules = [
                         'ad_id'  => 'required',
                        ];

               $validator = Validator::make($request->all(), $rules);

             if ($validator->fails()) {
                 $errors =  $validator->errors()->all();
                 return response(['status' => false , 'message' => $errors[0]] , 200);              
             }

             $adData = Ad::select('ads.*')
                        ->join('users','ads.user_id','=','users.id')
                        ->join('categories','ads.category_id','=','ads.category_id')
                        ->join('cities','ads.city_id','=','cities.id')
                        ->join('city_areas','ads.city_area_id','=','city_areas.id')
                        ->whereNull('ads.deleted_at')
                        ->whereNull('users.deleted_at')
                        ->where('ads.id',$inputs['ad_id'])
                        ->first();

            if($adData){
                  $ad = [];
                  $ad['ad_id']        = $adData->id;
                  $ad['title']        = $adData->title;
                  $ad['description']  = $adData->description;
                  $ad['condition_id'] = $adData->condition;
                  $ad['condition']    = $adData->condition ? __('New') : __('Used');
                  $ad['is_featured']  = $adData->is_featured;
                  $ad['images']       = $adData->images;
                  $ad['price']        = $adData->price;
                  $ad['category_id']      = $adData->category_id;
                  $ad['sub_category_id']  = $adData->sub_category_id;
                  $ad['category']     = $adData->category->title_name ?? '';
                  $ad['sub_category'] = $adData->subcategory->title_name ?? '';
                  $ad['brand'] = $adData->brand;
                  $isFavourite        = 0;
                  if($request->user_id){
                      $isFavourite = DB::table('favouriate_ads')->where('user_id',$request->user_id)->where('ad_id',$adData->id)->count();
                      $isFavourite = $isFavourite > 0 ? '1' : '0';
                  }
                  $ad['is_favouriate'] = $isFavourite;
                  $ad['is_sell']          = '1';
                  $ad['city_id']          = $adData->city_id;
                  $ad['city_are_id']      = $adData->city_area_id;
                  $ad['location']         = $adData->area->title_name ?? '' .' ('.$adData->city->title_name ?? '' .')';
                  $ad['city']             = $adData->city->title_name ?? '';
                  $ad['area']             = $adData->area->title_name ?? '';
                  $ad['ad_date']          = date('Y-m-d H:i:s',strtotime($adData->created_at));
                  $ad['seller_id']        = $adData->user_id;
                  $ad['seller_name']      = $adData->user->name;
                  $ad['seller_profile']   = $adData->user->profile_image;
                  $ad['seller_registration_date']   = date('Y-m-d',strtotime($adData->user->created_at ?? ''));
                  $ad['seller_email']     = $adData->user->email ?? '';
                  $ad['seller_phone']     = $adData->user->phone;
                  $ad['share_link']       = url('/') . '/ad/' . $adData->id .'/'. urlencode($adData->title);
                  $ad['is_deliver_to_buyer']  = $adData->is_deliver_to_buyer ?? 0;
                  $ad['is_hide_phone_number'] = $adData->is_hide_phone_number ?? 0;
                  $phoneNumbers = array();
                  if($adData->phone_numbers){
                       $phoneNumbers = unserialize($adData->phone_numbers);
                  }
                  
                  $ad['phone_numbers']        = $phoneNumbers;
                  $ad['is_negotiable']        = $adData->adDatavis_negotiable ?? 0;
                  $ad['lat']                  = $adData->lat   ?? NULL;
                  $ad['lng']                  = $adData->lng   ?? NULL;
                  $ad['map_address']          = $adData->map_address ?? NULL; 

                  $fields = \DB::table('ad_values')
                  ->select('ad_values.field_id','fields.name as field_name','fields.type as field_type','ad_values.value','field_options.option as field_option')
                  ->leftJoin('fields','ad_values.field_id','=','fields.id')
                  ->leftJoin('field_options','ad_values.option_id','=','field_options.id')
                  ->where('ad_id',$adData->id)->get();
                  $ad['fields'] = $fields;
               return ['status'=>true,'message'=> __('Record found') , 'data' => $ad ];
             }else{
               return ['status'=>false,'message'=> __('Record not not') ];
             }
    }

    public function adUpdate(Request $request){
       
       $input = $request->all();

       $rules = [
           'ad_id'             => 'required',
           'user_id'           => 'required',
           'city_id'           => 'required',
           'city_area_id'      => 'required',
           'title'             => 'required',
           'description'       => 'required',
           'price'             => 'required'
        ];
      
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }
        
        $Ad = Ad::find($input['ad_id']);

        $latitude   = $input['lat'] ?? null;
        $longitude  = $input['lng'] ?? null;
        $mapAddress = $Ad->map_address;

         
        if($latitude && $longitude){
           
         if($Ad->lat != $latitude && $Ad->lng != $longitude){
             $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyA--ohqdRW1EpW4DSnxuYSycDObj_IItC0&latlng='.trim($latitude).','.trim($longitude).'&sensor=false'); 
             $output = json_decode($geocodeFromLatLong);
             $status = $output->status;
             $mapAddress = ($status=="OK")?$output->results[1]->formatted_address:'';
         }

        }

        $adData = [
          'title'           => $input['title'],
          'description'     => $input['description'],
          'price'           => $input['price'],
          'city_id'         => $input['city_id'],
          'city_area_id'    => $input['city_area_id'],
          'user_id'         => $input['user_id'],
          'is_deliver_to_buyer'  => $input['is_deliver_to_buyer'] ?? 0,
          'is_hide_phone_number' => $input['is_hide_phone_number'] ?? 0,
          'phone_numbers'        =>  $input['phone_numbers'] ? serialize(explode(',',$input['phone_numbers'])) :  serialize(array()),
          'is_negotiable' => $input['is_negotiable'] ?? 0,
          'lat'                 => $latitude   ?? NULL,
          'lng'                 => $longitude  ?? NULL,
          'map_address'         => $mapAddress ?? NULL 
        ];
        DB::beginTransaction();
        try {
         DB::table('ads')->where('id',$input['ad_id'])->update($adData);
         $adId = $input['ad_id'];

         if(isset($input['image']) && !empty($input['image'])){
            $images = json_decode($input['image']);
            $imageData = array();
            foreach($images as $key => $value){
              array_push($imageData, ['ad_id' => $adId,'name' => $value->image]);
            }
         }

              DB::table('ad_values')->where('ad_id',$input['ad_id'])->delete();

              $adId = $input['ad_id'];
              
              $dynamicFieldDataStore = array();
              $formField = json_decode($request->form_field,true);
               if($formField){
                 foreach($formField as $key => $value){
                   array_push($dynamicFieldDataStore,[
                       'ad_id'     => $adId,
                       'field_id'  => $value['field'],
                       'option_id' => gettype($value['value']) != 'array' ? $value['value'] : null,
                       'value'     => gettype($value['value']) == 'array' ? json_encode($value['value']) : $value['value']
                   ]);
               }
             }
             
          if($dynamicFieldDataStore) 
             DB::table('ad_values')->insert($dynamicFieldDataStore);

             DB::table('ad_images')->where('ad_id',$adId)->delete();

          if($imageData)
             DB::table('ad_images')->insert($imageData);

          DB::commit();
          return ['status'=> true ,'message'=>__('Successfully updated ad')];
        } catch ( \Exception $e) {
          DB::rollback();
            return ['status'=> false ,'message'=> __('Failed to update ad') ];
        }
    }

    public function uploadAdImage(Request $request){

       $input = $request->all();
       $rules = [
           'image'     => 'required'
        ];
      
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = str_random('10').'.'.time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/ad/'), $fileName);
        }

        if($fileName){
          $data = [
              'name' => $fileName,
              'url'  => asset('images/ad/'.$fileName)
          ];
          return ['status'=>true,'message'=>__('Successfully uploaded image'),'data'=> $data];
        }else{
          return ['status'=>false,'message'=>__('Failed to upload image')];
        }

    }

    public function removeAdImage(Request $request){
       
       $input = $request->all();
       $rules = [
           'image_id'     => 'required',
           'ad_id'        => 'required'
        ];
      
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

         if(DB::table('ad_images')->where('id',$input['image_id'])->where('ad_id',$input['ad_id'])->delete()){
          return ['status'=>true,'message'=>__('Successfully removed image')];
        }else{
          return ['status'=>false,'message'=>__('Failed to remove image')];
        }
    }

     public function getImage($ad_id){
        $Ad = Ad::find($ad_id);
        $imageData = DB::table('ad_images')->select('name')->where('ad_id',$ad_id)->first();
        if(!$imageData)
             return asset('public/backend/images/' . $imageData->name );
        else
             return asset('public/backend/images/image-not-found.jpg');
     }

     public function chatUsers(Request $request){

      $user_id = $request->user_id;
      $search  = $request->search;

      $rules = [
        'user_id'        => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        $errors =  $validator->errors()->all();
        return response(['status' => false , 'message' => $errors[0]]);              
    }

       $userData = Chat::select('chats.*')
                        ->join('users as senders','chats.sender_id','=','senders.id')
                        ->join('users as receivers','chats.receiver_id','=','receivers.id')
                        ->join('ads','chats.ad_id','=','ads.id')
                        ->where(function($query) use ($user_id){
                           $query->where('sender_id',$user_id)->orWhere('receiver_id',$user_id);
                        })
                        ->where(function($query) use ($search) {
                              if($search){
                                $query->whereRaw('LOWER(ads.title) like ?', '%'.strtolower(trim($search)).'%')
                                      ->orWhereRaw('LOWER(senders.name) like ?', '%'.strtolower(trim($search)).'%')
                                      ->orWhereRaw('LOWER(receivers.name) like ?', '%'.strtolower(trim($search)).'%');
                              }
                         })
                         ->groupBy('chat_room_id')
                         ->orderBy('chats.id','desc')
                         ->get();
      if($userData->toArray()){
        $users = [];
        foreach($userData as $key => $value){
          $lastMsgData = \DB::table('chats')->where('chat_room_id',$value->chat_room_id)->orderBy('id','desc')->first();
          $unread_msg  = \DB::table('chats')->where('is_read','0')->where('chat_room_id',$value->chat_room_id)->count();
          if($user_id == $value->sender_id){
              $userData =  \DB::table('users')->where('id',$value->receiver_id)->first();
          }else{
              $userData =  \DB::table('users')->where('id',$value->sender_id)->first();
          }

          $temp = array();
          $temp['chat_id']  = $value->id;
          $temp['chat_room_id']  = $value->chat_room_id;
          $temp['ad_id']    = $value->ad_id;
          $temp['message']  = $lastMsgData->message;
          $temp['title']    = $value->ad->title;
          $temp['ad_image'] = $value->ad->image;
          $temp['user_id']  = $userData->id;
          $temp['unread_msg']  = $unread_msg ?? 0;
          $temp['user_name']  = $userData->name;
          $temp['user_profile'] = asset('public/images/profile/') .'/'. $userData->profile_image;
          $temp['is_online']  = $userData->is_online;
          if(!empty($userData->last_seen) && !is_null($userData->last_seen)){
            if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s',strtotime($userData->last_seen))) )
              $temp['last_seen']       =  date('Y-m-d h:i A',strtotime($userData->last_seen));
            else
              $temp['last_seen']       =  date('h:i A',strtotime($userData->last_seen));
          }else{
              $temp['last_seen']       = '';
          }

          if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s',strtotime($lastMsgData->created_at))) )
            $temp['time']       =  date('Y-m-d h:i A',strtotime($lastMsgData->created_at));
          else
            $temp['time']       =  date('h:i A',strtotime($lastMsgData->created_at));
          array_push($users, $temp);
        }
        return ['status' => true ,'message'=>'User found' , 'data'=>$users];
      }
        return ['status' => false ,'message'=>'User not found'];
}

     public function getChatRoomId($ad_id,$senderId,$receiverId){
       $chatRoomId  = $ad_id . '-';
       $chatRoomId .= min([$senderId,$receiverId]);
       $chatRoomId .= '-';
       $chatRoomId .= max([$senderId,$receiverId]);
       return $chatRoomId;
     }

     public function chatConversation(Request $request){
      
      $inputs = $request->all();
      $rules = [
        'ad_id'       => 'required',
        'sender_id'   => 'required',
        'receiver_id' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errors =  $validator->errors()->all();
        return response(['status' => false , 'message' => $errors[0]]);              
      }

     $sender_id    = $inputs['sender_id'];
     $receiver_id  = $inputs['receiver_id'];
     $ad_id        = $inputs['ad_id'];

     $chatRoomId = $this->getChatRoomId($ad_id,$sender_id,$receiver_id);

     $chatData = Chat::where('chat_room_id',$chatRoomId)->orderBy('id','desc')->first();

     $user = array();
     if($chatData){
          if($sender_id == $chatData->sender_id){
              $userData =  User::where('id',$chatData->receiver_id)->first();
          }else{
              $userData =  User::where('id',$chatData->sender_id)->first();
          }

          $user['ad_id']        = $chatData->ad_id;
          $user['chat_room_id'] = $chatData->chat_room_id;
          $user['title']      = $chatData->ad->title;
          $user['ad_image']   = $chatData->ad->image;
          $user['user_id']    = $userData->id;
          $user['user_name']  = $userData->name;
          $user['user_profile'] = $userData->profile_image;
          $user['is_online']  = $userData->is_online;
          if(!empty($userData->last_seen) && !is_null($userData->last_seen)){
            if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s',strtotime($userData->last_seen))) )
              $user['last_seen']       =  date('Y-m-d h:i A',strtotime($userData->last_seen));
            else
              $user['last_seen']       =  date('h:i A',strtotime($userData->last_seen));
          }else{
              $user['last_seen']       = '';
          }
          $user = (object) $user;
     }else{

            $userData =  User::where('id',$receiver_id)->first();
            $adData   =  Ad::where('id',$ad_id)->first();
            
            $user['ad_id']        = $adData->id;
            $user['chat_room_id'] = $chatRoomId;
            $user['title']        = $adData->title;
            $user['ad_image']     = $adData->image;
            $user['user_id']      = $userData->id;
            $user['user_name']    = $userData->name;
            $user['user_profile'] = $userData->profile_image;
            $user['is_online']    = $userData->is_online;
            if(!empty($userData->last_seen) && !is_null($userData->last_seen)){
            if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s',strtotime($userData->last_seen))) )
              $user['last_seen']       =  date('Y-m-d h:i A',strtotime($userData->last_seen));
            else
              $user['last_seen']       =  date('h:i A',strtotime($userData->last_seen));
            }else{
              $user['last_seen']       = '';
            }
            $user = (object) $user;
     }
        
        $dataData = Chat::where('chat_room_id',$chatRoomId)->get();

        if($dataData->toArray()){
          $users = array();
          foreach($dataData as $key => $value){
            $temp = [];
            $temp['chat_id']        = $value->id;
            $temp['chat_room_id']   = $value->chat_room_id;
            $temp['message']        = $value->message;
            $temp['sender_id']      = $value->sender_id;
            $temp['sender_name']    = $value->sender->name;
            $temp['sender_profile'] = $value->sender->profile_image;

            $temp['receiver_id']      = $value->receiver_id;
            $temp['receiver_name']    = $value->receiver->name;
            $temp['receiver_profile'] = $value->receiver->profile_image;

            if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s')))
              $temp['message_time']       =  date('Y-m-d h:i A',strtotime($value->created_at));
            else
              $temp['message_time']       =  date('h:i A',strtotime($value->created_at));
            array_push($users,$temp);
          }
          return ['status' => true ,'message'=>'User found' , 'user' => $user , 'data'=>$users];
        }
          return ['status' => true ,'message'=>'User found' , 'user' => $user , 'data'=>array()];
}

     public function getNotificationCount(Request $request){
        $receiverId = $request->user_id;
        $count = \DB::table('notifications')->where('receiver_id',$receiverId)->where('is_read','0')->count();
        return ['status'=>true,'message'=>__('Record found'),'count'=>$count];
     }

     public function getNotifications(Request $request){

      $receiverId = $request->user_id;
      $notifications = \DB::table('notifications')->where('receiver_id',$receiverId)->orderBy('notification_id','desc')->get();
      if($notifications->toArray()){
          $data = array();
          foreach($notifications as $key => $value){
              
            $id = '';$type = '';
            if($value->meta_data){
                $arr   = unserialize($value->meta_data);
                $id    = $arr['id'];
                $type  = $arr['type'];
            }

              array_push($data,[
                  'notification_id' => $value->notification_id,
                  'title'           => $value->title,
                  'body'            => $value->body,
                  'id'              => $id,
                  'type'            => $type,
                  'timestamp'       => date('Y-m-d H:i:s'),
                  'date'            => date('Y-m-d',strtotime($value->created_at)),
                  'time'            => date('h:i A',strtotime($value->created_at))
              ]);
          }
          \DB::table('notifications')->where('receiver_id',$receiverId)->update(['is_read'=>'1']);
          return ['status'=>true,'message'=>__('Record found'),'data'=>$data];
      }
      return ['status'=>false,'message'=>__('Record not found')];
    }

    public function contactUs(Request $request){

        $input = $request->all();

        $rules = [
          'name'        => 'required',
          'email'       => 'required',
          'message'     => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
          $errors =  $validator->errors()->all();
          return response(['status' => false , 'message' => $errors[0]]);              
      }

      $data = array(
        'name'  => $input['name'],
        'email' => $input['email'],
        'to'    => env('MAIL_SUPPORT_FROM'),
        'msg'   => $input['message']
      );

      \DB::table('contact_us')->insert([
        'name'    => $input['name'],
        'email'   => $input['email'],
        'message' => $input['message']
      ]);
      try{
        \Mail::send('mails.support', $data, function ($message) use($data) {
        $message->from( $data['email'] , env('MAIL_FROM_NAME') );
        $message->to($data['to'])->subject('kroykari Support');
        });
      }catch(\Exception $e){
        return ['status'=>false,'message'=>__('This email does not exist')];
      }

      return ['status'=>true,'message'=>__('Thank you to contact us')];

    }

    public function reportAd(Request $request){
     
      $input = $request->all();

      $rules = [
        'user_id'     => 'required',
        'ad_id'       => 'required',
        'type'        => 'required',
        'comment'     => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
          $errors =  $validator->errors()->all();
          return response(['status' => false , 'message' => $errors[0]]);              
      }

      $insertId = DB::table('report_ads')->insertGetId([
           'user_id' => $input['user_id'],
           'ad_id'   => $input['ad_id'],
           'status'  => '0',
           'type'    => $input['type'],
           'comment' => $input['comment']
      ]);

      if($insertId)
           return ['status'=>true,'message'=>__('Successfully submitted your report')];
      else 
           return ['status'=>false,'message'=>__('Failed to submit report')];
    }

    public function getformField(Request $request){
      
      $input = $request->all();

      $rules = [
        'category_id' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
          $errors =  $validator->errors()->all();
          return response(['status' => false , 'message' => $errors[0]]);              
      }
      
      $categoryFields = CategoryField::where('category_id',$input['category_id'])->get();

      if($categoryFields->toArray()){
        $data = array();
        foreach($categoryFields as $key => $value){
          if($value->field){

            $optionsData = $value->field->options ?? array();
            $options = array();
            if($optionsData){
              foreach($optionsData as $optionData){
                 array_push($options,[
                   'id'       => $optionData->id,
                   'field_id' => $optionData->field_id,
                   'option'   => $optionData->option,
                   'label'    => __($optionData->option)
                 ]);
              }
            }

            array_push($data,[
                  'category_id' => $value->category_id,
                  'field_id'    => $value->field_id,
                  'field_name'  => __($value->field->name),
                  'field_type'  => $value->field->type,
                  'options'     => $options ?? array()
            ]);
          }
        }
        return ['status'=>true,'message'=>__('Record found'),'data'=>$data];
      }
      return ['status'=>false,'message'=> __('Record not found')];
    }

    public function chatNotification(Request $request){
       
       $chatRoomId = $request->chat_room_id;
       $senderId   = $request->sender_id;
       $receiverId = $request->receiver_id;
       $msg        = $request->message;
      
       $senderData   = User::select('id','name','profile_image')->where('id',$senderId)->first();
       $receiverData = User::select('id','device_token','device_type','is_notify')->where('id',$receiverId)->first(); 
        
       $nofifyData   = array();
        array_push($nofifyData,[
            'title' => $msg,
            'body'  => $msg,
            'sender_id'   => $senderData->id,
            'receiver_id' => $receiverData->id,
            'id'          => $chatRoomId,
            'type'        => 'chat',
            'meta_data'   => ['id'=>$chatRoomId,'type'=>'chat'],
            'is_notify'    => $receiverData->is_notify,
            'device_token' => $receiverData->device_token,
            'device_type'  => $receiverData->device_type,
            'icon'         => $senderData->profile_image
        ]);
        NotificationHelper::send($nofifyData);
    }

    public function chatUser(Request $request){
      
      $inputs = $request->all();
      $rules = [
        'chat_room_id' => 'required',
        'user_id'      => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errors =  $validator->errors()->all();
        return response(['status' => false , 'message' => $errors[0]]);              
      }

     $sender_id    = $inputs['user_id'];
     $chatRoomId   = $inputs['chat_room_id'];
     $explodeChatRoomId = explode('-',$chatRoomId);
     $adId              = $explodeChatRoomId[0];
     if($sender_id == $explodeChatRoomId['1']){
           $receiver_id = $explodeChatRoomId['2']; 
     }else{
           $receiver_id = $explodeChatRoomId['1'];
     }

     $chatData = Chat::where('chat_room_id',$chatRoomId)->orderBy('id','desc')->first();

     $user = array();
     if($chatData){
          if($sender_id == $chatData->sender_id){
              $userData =  User::where('id',$chatData->receiver_id)->first();
          }else{
              $userData =  User::where('id',$chatData->sender_id)->first();
          }

          $user['ad_id']        = $chatData->ad_id;
          $user['chat_room_id'] = $chatData->chat_room_id;
          $user['title']      = $chatData->ad->title;
          $user['ad_image']   = $chatData->ad->image;
          $user['user_id']    = $userData->id;
          $user['user_name']  = $userData->name;
          $user['user_profile'] = $userData->profile_image;
          $user['is_online']  = $userData->is_online;
          $user['sender_id']    = $sender_id;
          $user['receiver_id']  = $receiver_id;
          if(!empty($userData->last_seen) && !is_null($userData->last_seen)){
            if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s',strtotime($userData->last_seen))) )
              $user['last_seen']       =  date('Y-m-d h:i A',strtotime($userData->last_seen));
            else
              $user['last_seen']       =  date('h:i A',strtotime($userData->last_seen));
          }else{
              $user['last_seen']       = '';
          }
          $user = (object) $user;
          return ['status' => true ,'message'=> __('Record found') , 'data' => $user ];
     }else{
           $adData = Ad::find($adId);
           $user['ad_id']        = $adData->id;
           $user['chat_room_id'] = $chatRoomId;
           $user['title']        = app()->getLocale() == 'bn' ? $adData->title_bn : $adData->title;
           $user['ad_image']     = $adData->image;
           $user['user_id']      = $adData->user->id;
           $user['user_name']    = $adData->user->name;
           $user['user_profile'] = $adData->user->profile_image;
           $user['is_online']    = $adData->user->is_online;
           $user['sender_id']    = $sender_id;
           $user['receiver_id']  = $receiver_id;
           if(!empty($adData->user->last_seen) && !is_null($adData->user->last_seen)){
             if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s',strtotime($adData->user->last_seen))) )
               $user['last_seen']       =  date('Y-m-d h:i A',strtotime($adData->user->last_seen));
             else
               $user['last_seen']       =  date('h:i A',strtotime($adData->user->last_seen));
           }else{
               $user['last_seen']       = '';
           }
           $user = (object) $user;
           return ['status' => true ,'message'=> __('Record found') , 'data' => $user ];

     }
          return ['status' => false ,'message'=>  __('Record not found')];
    }
}