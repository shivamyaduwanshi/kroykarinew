<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Response;
use DB;
use App\Mail\NotifyMail;
use Mail;
use App\Models\Ad;
use App;
use App\Models\City;
use App\Models\CityArea;

class AuthController extends Controller
{
    protected $guard = 'web';
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

     /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function login(Request $request){

           $input = $request->all();

           $rules = [
             'email'         => 'required|email',
             'password'      => 'min:6|required',
             'device_type'   => 'required',
           ];

           $validator = Validator::make($request->all(), $rules );

           if ($validator->fails()) {
               $errors =  $validator->errors()->all();
               return response(['status' => false , 'message' => $errors[0]]);              
           }

            if(!auth()->guard($this->guard)->attempt(array( 'email' => $input['email'] , 'password' => $input['password'] , 'role_id' => '2' ))) {
               return response(['status' => false , 'message' => __('Invalid credientials') ]);       
            } 
           

            $User = User::find(auth()->guard($this->guard)->id());

            auth::logout();

            // if($User->is_varify_email != '1'){
            //   return response(['status'=>false , 'message'=>__('Please verify your email address')]);
            // }

            if($User->is_active != '1'){
               return response(['status'=>false , 'message'=>__('Your are inactive , Please contact with your administrator')]);
            }

            $User->device_type  = $input['device_type']  ?? NULL;
            $User->device_token = $input['device_token'] ?? NULL;
            $User->update();
             
            $data['id']                = $User->id;
            $data['user_id']           = $User->id;
            $data['name']              = $User->name ?? '';
            $data['first_name']        = $User->first_name ?? '';
            $data['last_name']         = $User->last_name ?? '';
            $data['profile_image']     = $User->profile_image;
            $data['email']             = $User->email ?? '';
            $data['phone']             = $User->phone ?? '';
            $data['lang']              = $User->lang  ?? 'en';

            if($request->unique_id){
               \DB::table('favouriate_ads')->where('unique_id',$request->unique_id)->update(['user_id'=>$User->id]);
            }
           return response(['status' => true , 'message' => __('Successfully login') , 'data' => $data ]);
     }

     public function socialLogin(Request $request){
          
           $input = $request->all();
         
           $rules = [
              'name'               => 'required',
              'device_type'        => 'required',
              'social_id'          => 'required',
              'login_by'           => 'required',
           ];

           $validator = Validator::make($request->all(), $rules);

             if ($validator->fails()) {
               $errors =  $validator->errors()->all();
               return response(['status' => false , 'message' => $errors[0]]);              
             }

             $User = User::where('social_id',$input['social_id'])->whereNull('deleted_at')->first();

             if($User){
                if($User->is_active != '1'){
                  return response(['status'=>false , 'message'=>__('Your are inactive , Please contact with your administrator')]);
                }
             }else{
                $User = new User;
             }

                $User->name         = $input['name'];
                $nameArr            = explode(',',$input['name']);
                $firstName          = $nameArr[0];
                $lastName           = $nameArr[0] ?? '';
                $User->first_name   = $firstName;
                $User->last_Name    = $lastName;
                $User->device_type  = $input['device_type'] ?? NULL;
                $User->device_token = $input['device_token'] ?? NULL;
                $User->lang         = $input['lang'] ?? 'en';
                $User->login_by     = $input['login_by'];
                $User->social_id    = $input['social_id'];
                $User->role_id      = '2';
                if($User->save()){
                  if($request->unique_id){
                    \DB::table('favouriate_ads')->where('unique_id',$request->unique_id)->update(['user_id'=>$User->id]);
                 }
                 $User->user_id     = $User->id;
                 $User->profile_image = $User->profile_image;
                  return response(['status' => true , 'message' => __('Successfully login') , 'data' => $User]);
                }else{
                  return response(['status' => false , 'message' => __('Failed to login') ]);
                }
     }
    
     public function register(Request $request) {

           $input = $request->all();
         
           $rules = [
              'name'               => 'required',
              'email'              => 'required|unique:users,email,null,id,deleted_at,NULL',
           //   'phone'              => 'required|min:5|max:18|unique:users,phone,null,id,deleted_at,NULL',
              'password'           => 'required|min:6',
              'device_type'        => 'required'
           ];

           $validator = Validator::make($request->all(), $rules);

             if ($validator->fails()) {
               $errors =  $validator->errors()->all();
               return response(['status' => false , 'message' => $errors[0]]);              
             }
             
              $User = new User;
              $User->email        = $input['email'];
              $User->phone        = $input['phone'] ?? '';
              $User->name         = $input['name'];
              $nameArr            = explode(',',$input['name']);
              $firstName          = $nameArr[0];
              $lastName           = $nameArr[0] ?? '';
              $User->first_name   = $firstName;
              $User->last_Name    = $lastName;
              $User->device_type  = $input['device_type'] ?? NULL;
              $User->device_token = $input['device_token'] ?? NULL;
              $User->lang         = $input['lang'] ?? 'en';
              $User->password     = Hash::make($input['password']);
              $User->role_id      = '2';
              if($User->save()){
                // $mailData['name']     = $User->name;
                // $mailData['url']      = route('email.varification',encrypt($User->id));
                // $mailData['subject']  = 'Email Varification';
                // $mailData['template'] = 'email_varification';
                // $mailData['to']       = $User->email; 
                
                $data = array(
                  'name' => $User->name,
                  'to'   => $User->email
                );

                try{
                  \Mail::send('mails.registration_notification', $data, function ($message) use($data) {
                    $message->from( env('MAIL_WELCOME_FROM') , env('MAIL_FROM_NAME') );
                    $message->to($data['to'])->subject('Welcome To Kroykari');
                  });
                }catch(\Exception $e){

                }
                
                $data['id']      = $User->id;
                $data['user_id'] = $User->id;
                $data['name']    = $User->name;
                $data['email']   = $User->email;
                $data['profile_image'] = asset('backend/images/user-default-image.png');
                return response(['status' => true , 'message' => __('Registered successfully') , 'data' => $data]);
               }else{
                  return response(['status' => false , 'message' => __('Failed to register please try again') ]);
               }
     }

     public function forgotPassword(Request $request){

           $input = $request->all();
         
           $rules = [
              'email'  => 'required',
           ];

             $validator = Validator::make($request->all(), $rules);

             if ($validator->fails()) {
               $errors =  $validator->errors()->all();
               return response(['status' => false , 'message' => $errors[0]]);              
             }

             $User = User::where('email',$input['email'])->whereNull('deleted_at')->first();

             if($User){
                if($User->is_active != '1'){
                  return response(['status'=>false , 'message'=>__('Your are inactive , Please contact with your administrator')]);
                }

                $otp = rand(1000,9999);

              $mailData['name']     = $User->name;
              $mailData['subject']  = 'Forgot Password';
              $mailData['template'] = 'forgot_password';
              $mailData['to']       = $User->email;
              $mailData['otp']      = $otp;
              try{
                Mail::to($mailData['to'])->send(new NotifyMail($mailData));
              }catch(\Exception $e){
                return ['status'=>false,'message'=>__('This email does not exist')];
              }
              $User->otp  = $mailData['otp'];
              $User->otp_expiry_time = date('Y-m-d H:i:s',strtotime( date('Y-m-d H:i:s') . ' + 15 minute'));
              $User->update();
              $data = [
               'user_id' => $User->id,
               'otp'     => $otp
              ];
              return ['status'=>true,'message'=>__('Otp send to your registered email address'),'data'=>$data];
             }else{
                return ['status'=>false,'message'=>__('This email does not exist')];
             }
     }

     public function verifyOtp(Request $request){

           $input = $request->all();

           $rules = [
             'email'         => 'required|email',
             'otp'           => 'required'
           ];

           $validator = Validator::make($request->all(), $rules );

           if ($validator->fails()) {
               $errors =  $validator->errors()->all();
               return response(['status' => false , 'message' => $errors[0]]);              
           }

            $User = User::where('email',$input['email'])->where('otp',$input['otp'])->whereNull('deleted_at')->first();

            if($User){
                

                if($User->is_active != '1'){
                   return response(['status'=>false , 'message'=>__('Your are inactive , Please contact with your administrator')]);
                }

                if(strtotime($User->otp_expiry_time) < strtotime(date('Y-m-d H:i:s'))){
                      return response(['status' => false , 'message' => __('otp is expired') ]);
                }

                $User->device_type  = $input['device_type']  ?? NULL;
                $User->device_token = $input['device_token'] ?? NULL;
                $User->otp             = NULL;
                $User->otp_expiry_time = NULL;
                $User->update();

                $data['user_id']           = $User->id;
                $data['name']              = $User->name ?? '';
                $data['first_name']        = $User->first_name ?? '';
                $data['last_name']         = $User->last_name ?? '';
                $data['profile_image']     = $User->profile_image;
                $data['email']             = $User->email ?? '';
                $data['phone']             = $User->phone ?? '';
                $data['lang']              = $User->lang  ?? 'en';

                return response(['status' => true , 'message' => __('Otp is verify') , 'data' => $data ]);
            }else{
                return response(['status' => false , 'message' => __('Failed to verify otp') ]);
            }
     }

     public function createPassword(Request $request){
           $input = $request->all();
         
           $rules = [
              'user_id'        => 'required',
              'password'       => 'required|min:6',
           ];

            $validator = Validator::make($request->all(), $rules);

             if ($validator->fails()) {
               $errors =  $validator->errors()->all();
               return response(['status' => false , 'message' => $errors[0]]);              
             }

             $User = User::find($input['user_id']);
             
             if($User->is_active != '1'){
                 return response(['status'=>false , 'message'=>__('Your are inactive , Please contact with your administrator')]);
             }
             
             $User->password     = Hash::make($input['password']);

             if($User->update()){
                  return response(['status' => true , 'message' => __('Successfully created password')]);
             }else{
                  return response(['status' => false , 'message' => __('Failed to create password') ]);
             }
     }

     public function getProfile(Request $request) {
             $input = $request->all();
             $rules = [
               'user_id' => 'required'
             ];
             $validator = Validator::make($request->all(), $rules );
              if ($validator->fails()) {
                 $errors =  $validator->errors()->all();
                 return response(['status' => false , 'message' => $errors[0]]);              
              }
              $User = User::find($input['user_id']);
              if($User){
                $data = array();
                $data['user_id']    = $User->id;
                $data['name']       = $User->name;
                $data['first_name'] = $User->first_name;
                $data['last_name']  = $User->last_name;
                $data['email']      = $User->email;
                $data['phone']      = $User->phone;
                $data['profile_image']  = $User->profile_image;
                $data['address']        = $User->address;
                $data['lang']           = $User->lang;

                return ['status' => true , 'message' => __('Record found') , 'data' => $data ];
              }else{
                return ['status' => false   , 'message' => __('Something went wrong')];
              }
     }

     public function updateProfile(Request $request) {
         
           $input = $request->all();
           $id    = $input['user_id'] ?? null;
           $rules = [
              'user_id'        => 'required',
              'name'           => 'required',
              'phone'          => 'required',
              'email'          => 'required|unique:users,email,'.$id.',id,deleted_at,NULL',
           ];
           
           $validator = Validator::make($request->all(), $rules);

           if ($validator->fails()) {
             $errors =  $validator->errors()->all();
             return response(['status' => false , 'message' => $errors[0]]);              
           }

              $User = User::find($id);

              $fileName = null;
              if ($request->hasFile('profile_image')) {
                $fileName = str_random('10').'.'.time().'.'.request()->profile_image->getClientOriginalExtension();
                request()->profile_image->move(public_path('images/profile/'), $fileName);
              }
              
              $User->email        = $input['email'];
              $User->phone        = $input['phone'];
              $User->name         = $input['name'];
              $nameArr            = explode(',',$input['name']);
              $firstName          = $nameArr[0];
              $lastName           = $nameArr[0] ?? '';
              $User->name         = $input['name'];
              $User->first_name   = $firstName;
              $User->last_Name    = $lastName;
              $User->address      = $input['address'] ?? '';
              
              if($fileName)
                 $User->profile_image = $fileName;

              if($User->update()){
                return ['status' => true,'message'=> __('Successfully updated')];
              }
              else{
                return ['status' => true,'message'=> __('Failed to update')];
              }

     }

     public function uploadProfile(Request $request){
           
            $input = $request->all();
            $rules = [
              'user_id'        => 'required',
              'profile_image'  => 'mimes:jpeg,jpg,png|required',
            ];
           
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
              $errors =  $validator->errors()->all();
              return response(['status' => false , 'message' => $errors[0]]);              
            }

              $fileName = null;
              if ($request->hasFile('profile_image')) {
                  $fileName = str_random('10').'.'.time().'.'.request()->profile_image->getClientOriginalExtension();
                  request()->profile_image->move(public_path('images/profile/'), $fileName);
              }

               $User = User::find($input['user_id']);
               $User->profile_image = $fileName;
              
               if($User->update()){
                 return ['status' => true,'message'=> __('Successfully updated')];
               }else{
                return ['status' => true,'message'=> __('Failed to update')];
               }
     }

     public function changePassword(Request $request){
        
           $input    = $request->all();

           $rules = [
                     'user_id'           => 'required',
                     'old_password'      => 'required',
                     'new_password'      => 'min:6|required',
                    ];

           $validator = Validator::make($request->all(), $rules);

           if ($validator->fails()) {
             $errors =  $validator->errors()->all();
             return response(['status' => false , 'message' => $errors[0]] , 200);              
           }

           $User = User::find($input['user_id']);

            if (!(Hash::check($request->old_password,  $User->password))) {
                 return response(['status' => false , 'message' => 'Your old password does not matches with the current password  , Please try again'] , 200);
            }

            elseif(strcmp($request->old_password, $request->new_password) == 0){
                 return response(['status' => false , 'message' => 'New password cannot be same as your current password,Please choose a different new password'] , 200);
            }

             $User  = User::find($input['user_id']);
             $User->password = Hash::make($input['new_password']);
             if($User->update()){
              return response(['status' => true , 'message' => __('Successfully updated')] , 200);
             }
             return response(['status' => false , 'message' => __('Failed to update')] , 200);
     }

     public function changeLanguage(Request $request){
           $input    = $request->all();

           $rules = [
                     'user_id'  => 'required',
                     'lang'     => 'required'
                    ];

           $validator = Validator::make($request->all(), $rules);

           if ($validator->fails()) {
             $errors =  $validator->errors()->all();
             return response(['status' => false , 'message' => $errors[0]] , 200);              
           }

            $User  = User::find($input['user_id']);
            $User->lang = $input['lang'];
            if($User->update()){
              return response(['status' => true , 'message' => __('Successfully updated')] , 200);
            }
            return response(['status' => false , 'message' => __('Failed to update')] , 200);
     }

     public function getCities(){

         $cities = City::where('is_active','1')->whereNull('deleted_at')->orderBy('cities.title','asc')->get();

         $data = array();
         if($cities->toArray()){
            foreach ($cities as $key => $city) {
              $temp = [];
              $temp['city_id'] = $city->id;
              $temp['title']   = $city->title_name;
              array_push($data,$temp);
            }
         return ['status' => true,'message'=> __('Record found'),'data'=>$data];
         }
         return ['status' => false ,'message'=> __('Record not found')];
     }

     public function getCityAreas(Request $request){

           $input    = $request->all();

             $rules = [
                       'city_id'  => 'required',
                      ];

             $validator = Validator::make($request->all(), $rules);

             if ($validator->fails()) {
               $errors =  $validator->errors()->all();
               return response(['status' => false , 'message' => $errors[0]] , 200);              
             }
   
           $cityareas = CityArea::where('is_active','1')->whereNull('deleted_at')->where('city_id',$input['city_id'])->orderBy('city_areas.title','asc')->get();

           $data = array();
           if($cityareas->toArray()){
              foreach ($cityareas as $key => $cityarea) {
                $temp = [];
                $temp['city_id'] = $cityarea->id;
                $temp['title']   = $cityarea->title_name;
                array_push($data,$temp);
              }
           return ['status' => true,'message'=> __('Record found'),'data'=>$data];
           }
           return ['status' => false ,'message'=> __('Record not found')];
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
}