<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\User;
use App\Models\City;
use App\Models\Ad;
use App\Models\Division;
use Validator;
use App\Models\CityArea;
use App\Models\Like;
use App\Models\Chat;
use App\Helpers\WebNotification;
use App\Models\CategoryField;
use Hash;
use Auth;
use DB;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index','addAd','adShow','ads','contactUs','page',
          'emailVarification','help','changeLanguage','registrationSuccess');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['categories'] = $this->getCategories();
        $data['cities']     = $this->getCities();
        $data['ads']        = Ad::select('ads.*')->join('users as seller','ads.user_id','=','seller.id')
                                     ->where('ads.is_publish','1')
                                     ->where('ads.is_approved','1')
                                     ->where('ads.is_active','1')
                                  //   ->where('ads.is_featured','1')
                                     ->whereNull('ads.deleted_at')
                                     ->where('seller.is_active','1')
                                     ->whereNull('seller.deleted_at')
                                      ->orderBy('ads.id','desc')
                                     ->get();
        return view('home',compact('data'));
    }

    public function addAd(){
        $categories = Category::where('is_active','1')->whereNull('parent_id')->whereNull('deleted_at')->orderBy('title','asc')->get();
        if($categories->toArray()){
             foreach($categories as $key => $value){
                $categories[$key]->title = app()->getLocale() == 'bn' ? $value->title_bn : $value->title;
             }
        }
        return view('addAd',compact('categories'));
    }

    public function adCreate(){
        $data['categories'] = $this->getCategories();
        $data['cities']     = $this->getCities();
        return view('adCreate',compact('data'));
    }

    public function editAd($id){
        $data['categories']    = $this->getCategories();
        $data['cities']        = $this->getCities();
        $data['ad']            = Ad::find($id);
        $data['subCategories'] = $this->getSubCategories($data['ad']->category_id);
        $data['areas']         = $this->getAreas($data['ad']->city_id);
        $images                = $data['ad']->images;
        $imagesData            = array();
        $fields = array();

        $categoryFields = CategoryField::select('category_field.*')->where('category_id', $data['ad']->sub_category_id)->get();
        $optionValuesData = \DB::table('ad_values')->where('ad_id',$id)->get();
        $optionKeys       = array_column($optionValuesData->toarray(),'field_id');
        $optionValues     = array_column($optionValuesData->toarray(),'value');
        $optionsData      = array_combine($optionKeys,$optionValues);

        if ($categoryFields->toArray()) {
            foreach ($categoryFields as $key => $value) {
               
                if ($value->field) {
                    array_push($fields, [
                      'category_id' => $value->category_id,
                      'field_id'    => $value->field_id,
                      'field_name'  => $value->field->name,
                      'field_type'  => $value->field->type,
                      'field_value' => $optionsData[$value->field_id] ?? '',
                      'options'     => $value->field->options  ?? array()
                    ]);
                }
            }
        }
        $data['fields'] = $fields;
        return view('editAd',compact('data'));
    }

    public function adStore(Request $request){
       $input = $request->all();

       $rules = [
           'category'           => 'required',
           'sub_category'       => 'required',
           'city'               => 'required',
           'local_area'         => 'required',
           'title'              => 'required',
           'description'        => 'required',
           'price'              => 'required'
        ];

          // Validate 
         $validator = \Validator::make($request->all(), $rules);
         if($validator->fails()){
            return array('status' => 'error' , 'msg' => 'failed to add ad', '' , 'errors' => $validator->errors());
         }

          if($request->is_agree != '1'){
             return ['status'=>'warning','message'=>__('Please agree our policy')];
          }

         $canPost = auth::user()->canPost($input['category']);

         if(!$canPost){
           return ['status'=>'failed','message'=> __('You riched the maximum limit of post ad') ];
         }

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
          'category_id'     => $input['category'],
          'sub_category_id' => $input['sub_category'],
          'title'           => $input['title'],
          'description'     => $input['description'],
          'price'           => $input['price'],
          'city_id'         => $input['city'],
          'city_area_id'    => $input['local_area'],
          'user_id'         => auth::id(),
          'is_deliver_to_buyer'  => $input['is_deliver_to_buyer'] ?? 0,
          'is_hide_phone_number' => $input['is_hide_phone_number'] ?? 0,
          'phone_numbers'        =>  isset($input['phone_numbers']) && !empty($input['phone_numbers']) ? serialize($input['phone_numbers']) :  serialize(array()),
          'is_negotiable' => $input['is_negotiable'] ?? 0,
          'lat'                 => $latitude   ?? NULL,
          'lng'                 => $longitude  ?? NULL,
          'map_address'         => $mapAddress ?? NULL 
        ];
        DB::beginTransaction();
        try {
         $adId =  DB::table('ads')->insertGetId($adData);
         $imageData = array();
         if($request->hasFile('image')){
            foreach ($request->image as $key => $image) {
                $imageName = str_random('10').'.'.time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/ad/'), $imageName);
                array_push($imageData, ['ad_id' => $adId,'name' => $imageName]);
            }
         }

         $dynamicFieldDataStore = array();
         $dynamicFieldData      = $request->field;
         if($dynamicFieldData){
            foreach($dynamicFieldData as $key => $value){
               array_push($dynamicFieldDataStore,[ 
                      'ad_id'     => $adId,
                      'field_id'  => $key,
                      'option_id' => gettype($value) != 'array' ? $value : null,
                      'value'     => gettype($value) == 'array' ? json_encode($value) : $value
               ]);
            }
         }
         
          if($dynamicFieldDataStore) 
              DB::table('ad_values')->insert($dynamicFieldDataStore);

          if($imageData)
              DB::table('ad_images')->insert($imageData);
          DB::commit();
          return ['status'=>'success','message'=>__('Successfully added ad')];
        } catch ( \Exception $e) {
          DB::rollback();
            return ['status'=>'failed','message'=> $e->getMessage() ];
            return ['status'=>'failed','message'=> __('Failed to add ad') ];
        }
    }

    public function adUpdate(Request $request,$id){
       $input = $request->all();
       $rules = [
           'city'               => 'required',
           'local_area'         => 'required',
           'title'              => 'required',
           'description'        => 'required',
           'price'              => 'required',
        ];
          // Validate 
         $validator = \Validator::make($request->all(), $rules);
         if($validator->fails()){
            return array('status' => 'error' , 'msg' => 'failed to add ad', '' , 'errors' => $validator->errors());
         }

         $Ad = Ad::find($id);

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
          'city_id'         => $input['city'],
          'city_area_id'    => $input['local_area'],
          'is_deliver_to_buyer' => $input['is_deliver_to_buyer'] ?? 0,
          'is_hide_phone_number' => $input['is_hide_phone_number'] ?? 0,
          'phone_numbers'        =>  isset($input['phone_numbers']) && !empty($input['phone_numbers'])  ? serialize($input['phone_numbers']) :  serialize(array()),
          'is_negotiable' => $input['is_negotiable'] ?? 0,
          'lat'                 => $latitude   ?? NULL,
          'lng'                 => $longitude  ?? NULL,
          'map_address'         => $mapAddress ?? NULL 
        ];
        DB::beginTransaction();
        try {

                   DB::table('ads')->where('id',$id)->update($adData);
                   $input['image_id'] = $input['image_id'] ?? array();
                    DB::table('ad_images')->where('ad_id',$id)->whereNotIn('id',$input['image_id'])->delete();

         $imageData = array();
         if($request->hasFile('image')){
            foreach ($request->image as $key => $image) {
                $imageName = str_random('10').'.'.time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/ad/'), $imageName);
                array_push($imageData, ['ad_id' => $id,'name' => $imageName]);
            }
         }       

          if($imageData)
              DB::table('ad_images')->insert($imageData);
         
          DB::table('ad_values')->where('ad_id',$id)->delete();

          $dynamicFieldDataStore = array();
          $dynamicFieldData      = $request->field;
          if($dynamicFieldData){
             foreach($dynamicFieldData as $key => $value){
                array_push($dynamicFieldDataStore,[ 
                       'ad_id'     => $id,
                       'field_id'  => $key,
                       'option_id' => gettype($value) != 'array' ? $value : null,
                       'value'     => gettype($value) == 'array' ? json_encode($value) : $value
                ]);
             }
          }
          
           if($dynamicFieldDataStore) 
               DB::table('ad_values')->insert($dynamicFieldDataStore);

          DB::commit();
          return ['status'=>'success','message'=>__('Successfully updated ad')];
        } catch ( \Exception $e) {
          DB::rollback();
          return $e->getMessage();
            return ['status'=>'failed','message'=> __('Failed to add update ad') ];
        }
    }

    public function adDelete($id){
        try{
          $Ad = Ad::find($id);
          DB::beginTransaction();
          DB::table('ads')->where('id',$Ad->id)->delete();
          DB::table('chats')->where('ad_id',$Ad->id)->delete();
          DB::table('ad_images')->where('ad_id',$Ad->id)->delete();
          DB::table('ad_values')->where('ad_id',$Ad->id)->delete();
          DB::table('favouriate_ads')->where('ad_id',$Ad->id)->delete();
          DB::table('report_ads')->where('ad_id',$Ad->id)->delete();
          DB::commit();
          $Ad->deleteImages();
          return ['status'=>'success','message'=>__('Successfully deleted ad')];
        }catch(\Exception $e){
        DB::rollback();
          return ['status'=>'failed','message'=>__('Failed to delete ad')];
        }
    }

    public function favourite(){
      $data['likeAds'] = Like::join('ads','likes.ad_id','=','ads.id')
                                ->join('users as seller','ads.user_id','=','seller.id')
                                ->where('ads.is_publish','1')
                                ->where('ads.is_approved','1')
                                ->where('ads.is_active','1')
                                ->whereNull('ads.deleted_at')
                                ->where('seller.is_active','1')
                                ->whereNull('seller.deleted_at')
                                ->orderBy('likes.id','desc')
                                ->get();
      return view('favourite',compact('data'));
    }

    public function adShow($id){
       $data['ad'] = Ad::find($id);

       $data['fields'] = \DB::table('ad_values')
                         ->select('ad_values.field_id','fields.name as field_name','fields.type as field_type','ad_values.value','field_options.option as field_option')
                         ->leftJoin('fields','ad_values.field_id','=','fields.id')
                         ->leftJoin('field_options','ad_values.option_id','=','field_options.id')
                         ->where('ad_id',$id)->get();

       $data['ads']  = Ad::select('ads.*')->join('users as seller','ads.user_id','=','seller.id')
                     ->where('ads.is_publish','1')
                     ->where('ads.is_approved','1')
                     ->where('ads.is_active','1')
                     ->whereNull('ads.deleted_at')
                     ->where('seller.is_active','1')
                     ->whereNull('seller.deleted_at')
                     ->where('ads.category_id',$data['ad']->category_id)
                     ->orderBy('ads.id','desc')
                     ->get();

       if(auth::guest())
           $likeCount = 0;
       else
           $likeCount = DB::table('likes')->where('user_id',auth::id())->where('ad_id',$id)->count();

       $data['is_liked'] = $likeCount > 0 ? '1' : '0';
       return view('adShow',compact('data'));
    }

    public function myProfile(){
        $data['user'] = User::find(auth::id());
        return view('myProfile',compact('data'));      
    }

    public function myAds(){
        $data['user'] = User::find(auth::id());
        return view('myAds',compact('data'));
    }

    public function like(Request $request){
      $id = $request->id;
      $isExist = DB::table('likes') ->where('user_id',auth::id())->where('ad_id',$id)->first();
      if($isExist)
                 DB::table('likes')->where('user_id',auth::id())->where('ad_id',$id)->delete();
      else
      DB::table('likes')->insert(['user_id'=>auth::id(),'ad_id'=>$id]);
    }

    public function updateProfile(Request $request){
       $input = $request->all();
       $id = auth::id();
       $rules = [
           'name'   => 'required',
           'email'  => 'required|string|email|max:255|unique:users,email,'.$id.',id,deleted_at,NULL',
           'phone'  => 'required|string|unique:users,phone,'.$id.',id,deleted_at,NULL',
        ];
          // Validate 
         $validator = \Validator::make($request->all(), $rules);
         if($validator->fails()){
            return array('status' => 'error' , 'msg' => 'failed to update profile', '' , 'errors' => $validator->errors());
         }

        $fileName = null;
        if ($request->hasFile('profile_image')) {
            $fileName = str_random('10').'.'.time().'.'.request()->profile_image->getClientOriginalExtension();
            request()->profile_image->move(public_path('images/profile/'), $fileName);
        }

        $User = User::find($id);
        $User->name    = $input['name'];
        $User->email   = $input['email'];
        $User->phone   = $input['phone'];
        $User->address = $input['address']; 

        if($fileName){
          $User->profile_image = $fileName;
        }
  
        if($User->save())
            return ['status'=>'success','message'=>__('Successfully updated profile')];
          else
            return ['status'=>'failed','message'=>__('Failed to update profile')];
    }

       public function changePassword(Request $request){
         $input    = $request->all();
         $rules = [
                   'old_password'      => 'required',
                   'new_password'      => 'min:6|required_with:confirm_password|same:confirm_password',
                   'confirm_password'  => 'required|min:6',
                  ];

           // Validate 
        $validator = \Validator::make($request->all(), $rules);
        if($validator->fails()){
            return ['status' => 'error' , 'msg' => __('failed to update password'), '' , 'errors' => $validator->errors()];
        }

        if (!(Hash::check($request->old_password, auth()->user()->password))) {
             return ['status' => 'failed' , 'message' => __('Your old password does not matches with the current password  , Please try again')];
        }
        elseif(strcmp($request->old_password, $request->new_password) == 0){
             return ['status' => 'failed' , 'message' => __('New password cannot be same as your current password,Please choose a different new password')];
        }

         $User  = User::find(auth::id());
         $User->password = Hash::make($input['new_password']);
         if($User->update()){
           return ['status' => 'success' , 'message' => __('Successfully updated password')];
        }
           return ['status' => 'failed' , 'message' => __('Failed to update password')];
     }

     public function ads(Request $request){

       $data['ads']        = Ad::select('ads.*')
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
                                    ->where(function($query)use($request){

                                      if($request->search){
                                        $query->whereRaw('LOWER(ads.title) like ?', '%'.strtolower(trim($request->search)).'%');
                                        $query->orWhereRaw('LOWER(categories.title) like ?', '%'.strtolower(trim($request->search)).'%');
                                      }

                                      if($request->city){
                                        $query->whereRaw('LOWER(cities.title) like ?', '%'.strtolower(trim($request->city)));
                                      }

                                      if($request->area){
                                        $query->whereRaw('LOWER(city_areas.title) like ?', '%'.strtolower(trim($request->area)));
                                      }

                                      if($request->cat){
                                        $query->whereRaw('LOWER(categories.title) like ?', '%'.strtolower(trim($request->cat)));
                                      }

                                      if($request->min){
                                          $query->where('ads.price','>=',$request->min);
                                      }

                                      if($request->max){
                                         $query->where('ads.price','<=',$request->max);
                                      }

                                      if($request->sort){
                                          if($request->sort == 'featured'){
                                             $query->where('ads.is_featured', '1');      
                                          }
                                      }

                                });
       if($request->sort){
           if($request->sort == 'highest')
                 $data['ads']  = $data['ads']->orderBy('price','desc');

           if($request->sort == 'lowest')
                 $data['ads']  = $data['ads']->orderBy('price','asc');
       }else{
                  $data['ads'] = $data['ads']->orderBy('id','desc');
       }

        $data['ads'] = $data['ads']->paginate();
                                    
       $data['categories'] = $this->getCategories();
       $data['cities']     = $this->getCities();
       return view('ads',compact('data'));
     }

     public function page($page){
      
      if(app()->getLocale() == 'bn'){
        $config =  DB::table('config')->where('lang','bn')->where('key',strtolower($page))->first();
      }

      if(empty($config) || is_null($config)){
        $config =  DB::table('config')->where('lang','en')->where('key',strtolower($page))->first();
      }

      if($page == 'error'){
        return view('maintenance');
      }

      if($config){
        $content  = $config->value;
      }else{
        return view('error.404');
       }
      return view('page',compact('page','content'));
     }

    public function contactUs(){
      return view('contactUs');
    }

    public function contactMail(Request $request){

        $input = $request->all();

        $rules = [
          'name'        => 'required',
          'email'       => 'required',
          'message'     => 'required'
        ];

        // Validate 
        $validator = \Validator::make($request->all(), $rules);
        if($validator->fails()){
            return array('status' => 'error' , 'msg' => 'failed to add ad', '' , 'errors' => $validator->errors());
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
        }
      return ['status'=>'success','message'=>__('Thank you to contact us')];
    }

    public function help(){
      
      if(app()->getLocale() == 'bn'){
        $config =  DB::table('config')->where('lang','bn')->where('key','help')->first();
      }

      if(empty($config) || is_null($config)){
        $config =  DB::table('config')->where('lang','en')->where('key','help')->first();
      }

      if($config)
         $content  = $config->value;
       else
         $content  =  '';
         $page  = 'help';
      return view('page',compact('page','content'));
    }

    public function setting(){
      return view('setting');
    }

    public function chat(Request $request,$id = ''){

          $ad    = [];
          $ads   = [];
          $chats = [];
      
          if($id){
            
            $adData = Ad::find($id);
            $ad['ad_id']      = $adData->id;
            $ad['title']      = $adData->title;
            $ad['image']      = $adData->image;
            $ad['is_online']  = $adData->user->is_online;
            $ad['last_seen']  = $adData->user->last_seen ? date('Y-m-d h:i A',strtotime($adData->user->last_seen)) : '';

            $chatData = chat::where('ad_id',$id)
                        ->orderBy('id','asc')->get();

              if($chatData->toArray()){

              foreach ($chatData as $key => $value) {
                
                  if($key == 0){
                    if($adData->user_id == $value->receiver_id && $adData->user_id == auth::id()){
                        $ad['user_id'] = $value->sender_id;
                    }else{
                        $ad['user_id'] = $value->receiver_id;
                    }
                  }
                
                  $tmp = [];
                  $tmp['chat_id']   = $value->id;
                  $tmp['message']   = $value->message;
                  
                  if($value->sender_id == auth::id())
                      $tmp['is_send'] = '0';
                  else
                    $tmp['is_send']  = '1';

                  if(strtotime(date('Y-m-d',strtotime($value->created_at))) == strtotime(date('Y-m-d'))){
                    $tmp['time'] = date('h:i A',strtotime($value->created_at));
                  }else{
                    $tmp['time'] = date('Y-m-d h:i A',strtotime($value->created_at));
                  }
                  
                  array_push($chats, $tmp);
              }
            }

          }

            $adsData = chat::where(function($query) {
                                    $query->where('sender_id',auth::id());
                                    $query->orWhere('receiver_id',auth::id());
                            })
                            ->groupBy(['receiver_id','sender_id'])
                            ->orderBy('id','desc')->get();


            if($adsData->toArray()){
                foreach($adsData as $key => $value){
                  $tmp = [];
                  $tmp['chat_id']       = $value->id;
                  $tmp['title']         = $value->ad->title;
                  $tmp['message']       = $value->message;
                  $tmp['ad_image']      = $value->ad->image;
                  $tmp['ad_id']         = $value->ad_id;
                  if($value->receiver_id == auth::id()){
                        $tmp['user_id']       = $value->sender_id;
                        $tmp['last_seen'] = $value->sender->last_seen ?? '0';
                        $tmp['is_online'] = '1';
                  }
                  if($value->sender_id == auth::id()){
                        $tmp['user_id']       = $value->receiver_id;
                        $tmp['last_seen'] = $value->receiver->last_seen ?? '0';
                        $tmp['is_online'] = '1';
                  }

                  array_push($ads, $tmp);

                }
            }
            $data = ['ad'=>$ad,'ads'=>$ads,'chats'=>$chats];
            if($request->ajax()){
              return view('chat-box-list',compact('data'));
            }
            return view('chat',compact('data'));
    }

    public function chatNew(Request $request){

      $adId       = $request->ad_id;
      $senderId   = $request->sender_id;
      $receiverId = $request->receiver_id;
      $chatRoomId = $adId . '.';

      $chatRoomId .= min([$senderId,$receiverId]) . '.';
      $chatRoomId .= max([$senderId,$receiverId]);

      $chatData = Chat::where(function($query) use ($senderId,$receiverId){
         $query->where('sender_id',$senderId)->orWhere('receiver_id',$senderId);
      })->groupBy('chat_room_id')->get();

      $data = array();
      foreach($chatData as $key => $value){
            $lastMsgData = \DB::table('chats')->where('chat_room_id',$chatRoomId)->orderBy('id','desc')->first();          
            array_push($data,[
                 'ad_id'        => $value->ad_id,
                 'chat_room_id' => $value->chat_room_id,
                 'ad_image'  => $value->ad->image,
                 'last_msg'  => $lastMsgData->message,
                 'timestamp' => date('Y-m-d H:i:s',strtotime($lastMsgData->created_at))
            ]);
      }
      return view('chat',compact('data'));
    } 

      public function emailVarification($id){
       
       try {
         $User = User::findOrFail(decrypt($id));
         $status = '3';
         if($User){
            if($User->is_varify_email == '1'){
               $status = '2';
               return view('varification_email',compact('status'));
            }else{
              $User->is_varify_email = '1';
              if($User->update()){
                $status = '1';
                return view('varification_email',compact('status'));
              }else{
                $status = '3';
                return view('varification_email',compact('status'));
              }
           }
         }
       } catch (\Exception $e) {
           $status = '3';         
       }
          return view('varification_email',compact('status'));
     }

     public function registrationSuccess(){
       $status = true;
       return view('registrationSuccess',compact('status'));
     }

     public function changeLanguage(Request $request){
        $lang = $request->lang;
        session()->put('lang',$lang);
        App::setlocale($lang);
        if(!auth::guest()){
           DB::table('users')->where('id' , auth::guard()->user()->id)->update(['lang' => $lang]);
        }
        return redirect()->back();
    }

    public function getCategories(){
        return $data = Category::whereNull('parent_id')->where('is_active','1')->whereNull('deleted_at')->get();
    }

    public function getSubCategories($id){
       return Category::where('parent_id',$id)->whereNull('deleted_at')->orderBy('title','asc')->get();
    }

    public function getCities(){
        return City::where('is_active','1')->whereNull('deleted_at')->orderBy('title','asc')->get();
    }

    public function getAreas($id){
        return CityArea::where('is_active','1')->where('city_id',$id)->whereNull('deleted_at')->orderBy('title','asc')->get();
    }
    
    public function TestNotification(){
        
      $notifyData = array(
        'title'       => 'Title',
        'body'        => 'Body'
        );

        $deviceTokens = ['Hello Shiv!'];
        WebNotification::send($deviceTokens , $notifyData);
    }

    public function reportAd(Request $request){
      $input = $request->all();
      $rules = [
        'ad_id'       => 'required',
        'type'        => 'required',
        'comment'     => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
          $errors =  $validator->errors()->all();
          return response(['status' => 'failed' , 'message' => $errors[0]]);              
      }

      $insertId = DB::table('report_ads')->insertGetId([
           'user_id' => auth::id(),
           'ad_id'   => $input['ad_id'],
           'status'  => '0',
           'type'    => $input['type'],
           'comment' => $input['comment']
      ]);

      if($insertId)
           return ['status'=>'success','message'=>__('Successfully submitted your report')];
      else 
           return ['status'=>'failed','message'=>__('Failed to submit report')];
    }

    public function error(){
         return view('maintenance');
    }

}
