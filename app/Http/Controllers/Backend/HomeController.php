<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Category;
use App\Models\CityArea;
use App\Models\Config;
use App\Models\City;
use App\Exports\GerenateReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Ad;
use App\Mail\NotifyMail;
use App\Models\Field;
use Mail;
use Image;
use DB;
use auth;

class HomeController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
        $this->middleware('admin');
     }

     public function home(Request $request){
       $data['totalUser']    = User::where('id','!=',1)->count();
       return view('backend.home',compact('data'));
     }

     public function profile(Request $request){
      $data['user']  = User::find(auth::id());
      return view('backend.profile',compact('data'));
     }

     public function generateReport(Request $request){

      $adsData = Ad::select('ads.*')
      ->join('users','ads.user_id','=','users.id')
      ->leftJoin('categories','ads.category_id','=','categories.id')
      ->where(function($query) use ($request){
            if($request->search){
                 $query->whereRaw('LOWER(ads.title) like ?', '%'.strtolower($request->search).'%');
                 $query->orWhereRaw('LOWER(users.email) like ?', '%'.strtolower($request->search).'%');
                 $query->orWhereRaw('LOWER(users.phone) like ?', '%'.strtolower($request->search).'%');
                 $query->orWhereRaw('LOWER(categories.title) like ?', '%'.strtolower($request->search).'%');
            }
                if ($request->status == 'pending') {
                    $query->where('ads.is_approved', '0');
                }
                 if($request->status == 'rejected') {
                  $query->where('ads.is_approved', '2');
                 }
                 if($request->status == 'running') {
                   $query->where('ads.is_approved', '1');
                 }
      });

         if($request->status == 'deleted'){
            $adsData = $adsData->withTrashed()->whereNotNull('ads.deleted_at');
         }else{
            $adsData = $adsData->whereNull('ads.deleted_at');
         }

         $adsData = $adsData->orderBy('ads.id','desc')
               ->where('users.deleted_at')
               ->get();

            $ads = array();
            if ($adsData->toArray()) {
                foreach ($adsData as $key => $ad) {
                    $temp = [];
                    $temp['ad_id']  = $ad->id;
                    $temp['title']  = $ad->title;
                    $temp['is_featured']  = $ad->is_featured;
                    $temp['image']  = $ad->image;
                    $temp['price']  = $ad->price;
                    $temp['category']  = $ad->category->title_name ?? '';
                    $temp['user']      = $ad->user->name;
                    $temp['sub_category']  = $ad->subcategory->title_name ?? '';
                    $temp['created_at']  = $ad->created_at;
                    $temp['is_sell']       = '1';
                    $temp['location'] = $ad->area->title_name ?? '' .' ('.$ad->city->title_name ?? '' .')';
                    array_push($ads, $temp);
                }
            }
       return Excel::download(new GerenateReportExport($ads), 'ad-report-'.date('Y-m-d').'.xls');
     }

     public function updateProfile(Request $request){
        $input = $request->all();
        $id    = auth::id();
        $rules = array(
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users,email,'.$id.',id,deleted_at,NULL',
            'phone'      => 'required|unique:users,phone,'.$id.',id,deleted_at,NULL',
        );

        // Validate 
        $validator = \Validator::make($request->all(), $rules);
        if($validator->fails()){
            return array('status' => 'error' , 'msg' => 'failed to update profile', '' , 'errors' => $validator->errors());
        }

        $fileName = null;
        if ($request->hasFile('profile_image')) {
            $fileName = str_random('10').'.'.time().'.'.request()->profile_image->getClientOriginalExtension();
            request()->profile_image->move(public_path('images/profile'), $fileName);
        }
        
        $User = User::find($id);
        $User->name      = $input['name'];
        $User->email     = $input['email'];
        $User->phone     = $input['phone']   ?? '';
        if($fileName){
          $User->profile_image = $fileName;
        }
        if($User->update()){
        	return ['status'=>'success','message'=>'Successully updated profile'];
        }else{
        	return ['status'=>'failed','message'=>'Failed to update profile'];
        }
     }

     public function users(Request $request){
        $this->authorize('index', User::class);
        $users = User::where(function($query) use ($request){
                           if($request->search){
                              $query->whereRaw('LOWER(name) like ?', '%'.strtolower($request->search).'%');
                              $query->orWhereRaw('LOWER(email) like ?', '%'.strtolower($request->search).'%');
                              $query->orWhereRaw('LOWER(phone) like ?', '%'.strtolower($request->search).'%');
                           }
                      })
                      ->orderBy('id','desc')
                      ->where('role_id','2')
                      ->paginate(10);
        $data = array('users'=>$users);
        return view('backend.user',compact('data'));
     }

     public function userDetails($id){
      $this->authorize('index', User::class);
       $user = User::find($id);
       $data = array('user'=>$user);
       return view('backend.user-details',compact('data'));
     }

     public function userChangeStatus($id){
      $this->authorize('active', User::class);
        $user   = User::find($id);
        $status = $user->is_active;
        $user->is_active = $status == '1' ? '0' : '1';
        if($status == '1')
             $text = 'inactive';
        else
             $text = 'active';
        if($user->update())
             return ['status'=>'success','message'=>'Successully ' . $text .' user'];
         else
             return ['status'=>'failed','message'=>'Failed to ' . $text .' user'];
     }

     public function ads(Request $request){
      $this->authorize('index', Ad::class);
       $ads = Ad::select('ads.*')
                      ->join('users','ads.user_id','=','users.id')
                      ->leftJoin('categories','ads.category_id','=','categories.id')
                      ->where(function($query) use ($request){
                            
                            if($request->search){
                                 $query->whereRaw('LOWER(ads.title) like ?', '%'.strtolower($request->search).'%');
                                 $query->orWhereRaw('LOWER(users.email) like ?', '%'.strtolower($request->search).'%');
                                 $query->orWhereRaw('LOWER(users.phone) like ?', '%'.strtolower($request->search).'%');
                                 $query->orWhereRaw('LOWER(categories.title) like ?', '%'.strtolower($request->search).'%');
                            }

                                if ($request->status == 'pending') {
                                    $query->where('ads.is_approved', '0');
                                }
                                 if($request->status == 'rejected') {
                                  $query->where('ads.is_approved', '2');
                                 }
                                 if($request->status == 'running') {
                                   $query->where('ads.is_approved', '1');
                                 }
                      });
                      

                 if($request->status == 'deleted'){
                     $ads = $ads->withTrashed()->whereNotNull('ads.deleted_at');
                 }else{
                     $ads = $ads->whereNull('ads.deleted_at');
                 }

                 $ads = $ads->orderBy('ads.id','desc')
                      ->where('users.deleted_at')
                      ->paginate();

        $data = array('ads'=>$ads);
        return view('backend.product',compact('data'));
     }

     public function adDetails(Request $request){
         $this->authorize('index', Ad::class);
         $id = $request->id;
         $data['ad']    = Ad::withTrashed()->find($id);
         $data['user']  = User::find($data['ad']->user_id);
         $data['fields'] = \DB::table('ad_values')
         ->select('ad_values.field_id','fields.name as field_name','fields.type as field_type','ad_values.value','field_options.option as field_option')
         ->leftJoin('fields','ad_values.field_id','=','fields.id')
         ->leftJoin('field_options','ad_values.option_id','=','field_options.id')
         ->where('ad_id',$id)->get();
         return view('backend.product-details',compact('data'));
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
            return ['status' => 'error' , 'msg' => __('failed to update apartment'), '' , 'errors' => $validator->errors()];
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

     public function categories(Request $request){
      $this->authorize('index', Category::class);
       $categories = Category::select('categories.*')->where(function($query) use ($request){
                           if($request->search){
                              $query->whereRaw('LOWER(title) like ?', '%'.strtolower($request->search).'%');
                           }
                      })->whereNull('parent_id')->orderBy('categories.title','asc')->whereNull('deleted_at')->get();
       $data['categories'] = $categories;
       return view('backend.categories',compact('data'));
     }

     public function addCategory(Request $request){
        $this->authorize('create', Category::class);
        $data['categories']  = Category::whereNull('parent_id')->orderBy('title','asc')->get();
        return view('backend.add-category',compact('data'));
     }

     public function storeCategory(Request $request){
      $this->authorize('create', Category::class);
        $input = $request->all();
        $rules = [
           'english_title' => 'required',
           'bangla_title'  => 'required',
           'image'         => 'mimes:jpeg,jpg,png|max:10000'
        ];
        $request->validate($rules);

        $category = new Category;
        $category->title         = $input['english_title'];
        $category->title_bn      = $input['bangla_title'];
        $category->posting_allowance = $input['posting_allowance'] ?? '0';

        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = str_random('10').'.'.time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/category'), $fileName);
        }

        if($fileName)
             $category->image = $fileName;
  
        if ($category->save()) {
            return redirect()->route('admin.categories')->with('status', true)->with('message', 'Successfully added category');
        }else
          return redirect()->route('admin.categories')->with('stautus',false)->with('message','Failed to added category');
     }

     public function categoryDetail($id){
       $this->authorize('index', Category::class);
        $data['categories']  = Category::whereNull('parent_id')->orderBy('title','asc')->get();
        $data['category']    = Category::find($id);
        if($data['categories']->toArray()){
             foreach($data['categories'] as $key => $category){
                 if($category->id == $data['category']->parent_id)
                  $data['categories'][$key]->is_selected = true;
                 else
                  $data['categories'][$key]->is_selected = false;
             }
        }
        $data['fields'] = Field::whereNull('deleted_at')->orderBy('name','asc')->get();
        return view('backend.category-details',compact('data'));
     }

     public function categoryUpdate(Request $request,$id){
      $this->authorize('update', Category::class);
       $categoryId = $id;
       $input = $request->all();
       $rules = [
           'english_title' => 'required',
           'bangla_title'  => 'required',
           'image'         => 'mimes:jpeg,jpg,png|max:10000'
        ];
        $request->validate($rules);

        $category = Category::find($categoryId);
        $category->title         = $input['english_title'];
        $category->title_bn      = $input['bangla_title'];
        $category->posting_allowance = $input['posting_allowance'] ?? '0';

        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = str_random('10').'.'.time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/category'), $fileName);
        }

        if($fileName)
             $category->image = $fileName;
  
        if($category->update())
          return redirect()->route('admin.categories')->with('status',true)->with('message',__('Successfully updated category'));
        else
          return redirect()->route('admin.categories')->with('stautus',false)->with('message',__('Failed to update category'));

     }

     public function removeParentCategory($id){
      $this->authorize('delete', Category::class);
       $category = Category::find($id);
       $category->deleted_at = date('Y-m-d H:i:s');
       if($category->update())
           return ['status'=>'success','message'=>'Category deleted successfully'];
         else
           return ['status'=>'failed','message'=>'Failed to delete category'];
    }

     public function removeCity($id){
      $this->authorize('delete', City::class);
      $City = City::find($id);
      $City->deleted_at = date('Y-m-d H:i:s');
      if($City->update())
          return ['status'=>'success','message'=>'City deleted successfully'];
        else
          return ['status'=>'failed','message'=>'Failed to delete city'];
     }


      public function removeCategory(Request $request){
         $this->authorize('delete', Category::class);
       $input = $request->all();
       $rules = [
           'parent_category' => 'required',
           'sub_category'    => 'required',
        ];
        $request->validate($rules);

        $category = Category::where('parent_id',$input['parent_category'])->where('id',$input['sub_category'])->update(['deleted_at'=>date('Y-m-d H:i:s')])->first();
  
        if($category->update())
            return redirect()->route('admin.categories')->with('status',true)->with('message',__('Successfully deleted category'));
          else
            return redirect()->route('admin.categories')->with('status',false)->with('message',__('Failed to delete category'));
     }

     public function addSubcategory(Request $request){
      $this->authorize('create', Category::class);
       $input = $request->all();
       $rules = [
           'parent_category_id' => 'required',
           'english_title'      => 'required',
           'bangla_title'       => 'required'
        ];
          // Validate 
         $validator = \Validator::make($request->all(), $rules);
         if($validator->fails()){
            return array('status' => 'error' , 'msg' => 'failed to add product', '' , 'errors' => $validator->errors());
         }

        $category = new Category;
        $category->parent_id     = $input['parent_category_id'];
        $category->title         = $input['english_title'];
        $category->title_bn      = $input['bangla_title'];
  
        if($category->save()){
         if (isset($input['field'])) {
            $categoryFieldStoreData = array();
            \DB::table('category_field')->where('category_id', $category->id)->delete();
            foreach ($input['field'] as $field) {
                array_push($categoryFieldStoreData, [
                 'category_id' => $category->id,
                 'field_id'    => $field
           ]);
            }
            \DB::table('category_field')->insert($categoryFieldStoreData);
        }
           return ['status'=>'success','message'=>__('Successfully added sub category')];
        }else{
             return ['status'=>'success','message'=>__('Failed to add sub category')];
          }
     }

     public function updateSubcategory(Request $request){
       $this->authorize('update', Category::class);
       $input = $request->all();
       $rules = [
           'parent_category_id' => 'required',
           'category_id'        => 'required',
           'english_title'      => 'required',
           'bangla_title'       => 'required'
        ];
          // Validate 
         $validator = \Validator::make($request->all(), $rules);
         if($validator->fails()){
            return array('status' => 'error' , 'msg' => 'failed to update product', '' , 'errors' => $validator->errors());
         }

        $category = Category::find($input['category_id']);
        $category->parent_id     = $input['parent_category_id'];
        $category->title         = $input['english_title'];
        $category->title_bn      = $input['bangla_title'];

        if($category->update()){
          if (isset($input['field'])) {
            $categoryFieldStoreData = array();
            \DB::table('category_field')->where('category_id', $category->id)->delete();
            foreach ($input['field'] as $field) {
                array_push($categoryFieldStoreData, [
                 'category_id' => $category->id,
                 'field_id'    => $field
           ]);
            }
            \DB::table('category_field')->insert($categoryFieldStoreData);
          }
           return ['status'=>'success','message'=>__('Successfully updated sub category')];
        }else{
             return ['status'=>'success','message'=>__('Failed to update sub category')];
          }
     }

    public function removeSubcategory(Request $request,$id){
       $this->authorize('delete', Category::class);
       $input = $request->all();
       $category = Category::where('parent_id',$input['parent_category_id'])->where('id',$id)->first();
       $category->deleted_at = date('Y-m-d H:i:s');
        if($category->update())
            return ['status'=>'success','message'=>__('Successfully deleted sub category')];
          else
            return ['status'=>'failed','message'=>__('Failed to delete sub category')];
     }

     public function addSubcategoryAjax($id){
         $this->authorize('create', Category::class);
         $data['category'] = Category::find($id);
         $data['fields'] = Field::whereNull('deleted_at')->orderBy('name','asc')->get();
         return view('backend.sub-category-list',compact('data'));
     }

     public function config(Request $request){
      $this->authorize('index', Config::class);
        $data['config'] = Config::where(function($query) use ($request){
                if($request->key){
                        $query->where('key', 'like', '%' . $request->key . '%');
                           }
        })->orderBy('key','asc')->get();
        return view('backend.config',compact('data'));
     }

     public function getConfig($id){
      $this->authorize('index', Config::class);
        $data['config'] = Config::find($id);
        return view('backend.editConfig',compact('data'));
     }

     public function updateConfig(Request $request,$id){
      $this->authorize('update', Config::class);
        $input = $request->all();
        $rules = array(
            'key'       => 'required',
            'value'     => 'required',
        );
        $request->validate($rules);
        $config = Config::find($id);
        $config->value = $input['value'];
        if($config->update())
            return redirect()->route('admin.config')->with('status',true)->with('message','Successfully updated');
        else
            return redirect()->route('admin.config')->with('status',false)->with('message','Failed to update config');
     }

     public function  cities(Request $request){
      $this->authorize('index', City::class);
        $data['cities'] = City::select('cities.*')
                         ->leftJoin('city_areas','cities.id','=','city_areas.city_id')
                         ->where(function($query) use ($request){
                           if($request->search){
                              $query->whereRaw('LOWER(cities.title) like ?', '%'.strtolower($request->search).'%');
                              $query->orWhereRaw('LOWER(city_areas.title) like ?', '%'.strtolower($request->search).'%');
                           }
                          })
                           ->whereNull('cities.deleted_at')
                         //  ->whereNull('city_areas.deleted_at')
                          ->orderBy('cities.id','desc')
                          ->groupBy('cities.id')
                          ->get();
        return view('backend.cities',compact('data'));
     }

     public function addCity(){
      $this->authorize('create', City::class);
        return view('backend.add-city');
     }

     public function editCity($id){
      $this->authorize('index', City::class);
        $data['city'] = City::find($id);
        return view('backend.city-details',compact('data'));
     }

     public function storeCity(Request $request){
      $this->authorize('create', City::class);
        $input = $request->all();
        $rules = [
           'english_title' => 'required|string|unique:cities,title,null,id,deleted_at,NULL',
           'bangla_title'  => 'required|string|unique:cities,title_bn,null,id,deleted_at,NULL',
           'type'          => 'required',
        ];
        $request->validate($rules);
        $city = new City;
        $city->title         = $input['english_title'];
        $city->title_bn      = $input['bangla_title'];
        $city->type          = $input['type'];
        if($city->save())
          return redirect()->route('admin.cities')->with('status',true)->with('message',__('Successfully added city'));
        else
          return redirect()->route('admin.cities')->with('stautus',false)->with('message',__('Failed to added city'));
     }

     public function updateCity(Request $request,$id){
      $this->authorize('update', City::class);
        $input = $request->all();
        $rules = [
         'english_title' => 'required|string|unique:cities,title,'.$id.',id,deleted_at,NULL',
         'bangla_title'  => 'required|string|unique:cities,title_bn,'.$id.',id,deleted_at,NULL',
           'type'        => 'required'
        ];
        $request->validate($rules);

        $city = City::find($id);
        $city->title         = $input['english_title'];
        $city->title_bn      = $input['bangla_title'];
        $city->type          = $input['type'];
        if($city->update())
          return redirect()->route('admin.cities')->with('status',true)->with('message',__('Successfully updated city'));
        else
          return redirect()->route('admin.cities')->with('stautus',false)->with('message',__('Failed to update city'));
     }
     
     public function updateCityLocalarea(Request $request,$id){
      $this->authorize('update', City::class);
        $input = $request->all();
        $rules = [
           'english_title' => 'required',
           'bangla_title'  => 'required',
        ];
        $request->validate($rules);
        $CityArea = CityArea::find($id);
        $CityArea->title         = $input['english_title'];
        $CityArea->title_bn      = $input['bangla_title'];
        if($CityArea->update())
           return ['status'=>'success','message'=>__('Successfully updated city area')];
        else
           return ['status'=>'failed','message'=>__('Failed to update city area')];
     }



    public function addArea(Request $request){
      $this->authorize('create', City::class);
       $input = $request->all();
       $rules = [
           'city_id'            => 'required',
           'english_title'      => 'required',
           'bangla_title'       => 'required'
        ];
          // Validate 
         $validator = \Validator::make($request->all(), $rules);
         if($validator->fails()){
            return array('status' => 'error' , 'msg' => __('failed to add area'), '' , 'errors' => $validator->errors());
         }

        $CityArea = new CityArea;
        $CityArea->city_id       = $input['city_id'];
        $CityArea->title         = $input['english_title'];
        $CityArea->title_bn      = $input['bangla_title'];
  
        if($CityArea->save())
            return ['status'=>'success','message'=>__('Successfully added area')];
          else
            return ['status'=>'failed','message'=>__('Failed to add area')];
    }

    public function updateArea(Request $request){
      $this->authorize('update', City::class);
      $input = $request->all();
       $rules = [
           'area_id'            => 'required',
           'english_title'      => 'required',
           'bangla_title'       => 'required'
        ];
          // Validate 
         $validator = \Validator::make($request->all(), $rules);
         if($validator->fails()){
            return array('status' => 'error' , 'msg' => __('failed to update area'), '' , 'errors' => $validator->errors());
         }

        $CityArea = CityArea::find($input['area_id']);
        $CityArea->title         = $input['english_title'];
        $CityArea->title_bn      = $input['bangla_title'];

        if($CityArea->update())
            return ['status'=>'success','message'=>__('Successfully updated area')];
          else
            return ['status'=>'failed','message'=>__('Failed to update  area')];
    }

    public function removeArea(Request $request,$id){
       $this->authorize('delete', City::class);
       $input = $request->all();
       $CityArea = CityArea::where('city_id',$input['city_id'])->where('id',$id)->first();
       $CityArea->deleted_at = date('Y-m-d H:i:s');
        if($CityArea->update())
            return ['status'=>'success','message'=>__('Successfully deleted area')];
          else
            return ['status'=>'failed','message'=>__('Failed to delete sub area')];
    }

    public function ajaxAreaAjax($id){
      $this->authorize('index', City::class);
       $data['city'] = City::find($id);
       return view('backend.city-area-list',compact('data'));
    }

     public function approvedAd($id){
         $this->authorize('approve', Ad::class);
         $Ad = Ad::find(decrypt($id));
         $Ad->is_approved = '1';
            if($Ad->update()){
            $mailData['name']     = $Ad->user->name;
            $mailData['subject']  = 'Ad Status';
            $mailData['template'] = 'ad_user_mail';
            if($Ad->user->lang == 'bn'){
              $mailData['hello']  = 'হ্যালো';
              $mailData['msg'] = 'আপনার বিজ্ঞাপন "'.$Ad->title.'" অনুমোদিত হয়েছে';
            }else{
              $mailData['hello']  = 'Hello';
              $mailData['msg']= 'your ad '.$Ad->title.' was approved';
            }
            $mailData['to']       = $Ad->user->email; 
            if($Ad->user->email)
                 Mail::to($mailData['to'])->send(new NotifyMail($mailData));
          
            if($Ad->adImages){
               foreach($Ad->adImages as $adImage){
                  if($adImage->is_watermark != '1'){
                     $waterMarkUrl = public_path('frontend/images/logo-gray.png');
                     $image = Image::make(public_path('images/ad/' . $adImage->name));
                     $image->insert($waterMarkUrl, 'bottom-right', 25,25);
                     $image->save(public_path('images/ad/' . $adImage->name));
                  }
               }
               \DB::table('ad_images')->where('ad_id',$Ad->id)->update(['is_watermark' => '1']);
            }

            return redirect()->back()->with('status',true)->with('message','Successfully approved');
         }else{
            return redirect()->back()->with('status',false)->with('message','Failed to approve');
        }
     }

      public function rejectAd(Request $request,$id){
         $this->authorize('reject', Ad::class);
         $Ad = Ad::find(decrypt($id));
         $Ad->reject_reason = $request->reason ?? NULL;
         $Ad->rejected_date = date('Y-m-d H:i:s');
         $Ad->is_approved = '2';
         if($Ad->update()){
            $mailData['name']     = $Ad->user->name;
            $mailData['subject']  = 'Ad Status';
           if($Ad->user->lang == 'bn'){
              $mailData['hello']    = 'হ্যালো';
              $mailData['msg']  = 'আপনার বিজ্ঞাপন "'.$Ad->title.'" প্রত্যাখ্যান করা হয়েছিল';
           }else{
              $mailData['hello']   = 'Hello';
              $mailData['msg'] = 'your ad '.$Ad->title.' was rejected';
           }
            $status = 'your ad '.$Ad->title.' was rejected';
            $mailData['template'] = 'ad_user_mail';
            $mailData['msg']   = $status;
            $mailData['to']       = $Ad->user->email;
            $mailData['due']      = $request->reason; 
            if($Ad->user->email){
               try{
               \Mail::to($mailData['to'])->send(new NotifyMail($mailData));
               }catch(\Exception $e){
               }
            }
              
            return redirect()->back()->with('status',true)->with('message','Successfully rejected');
         }
        else{
            return redirect()->back()->with('status',false)->with('message','Failed to reject');
        }
     }

     public function deleteAd(Request $request,$id){
      $this->authorize('delete', Ad::class);
      $Ad = Ad::find(decrypt($id));
      $Ad->deleted_reason = $request->reason ?? NULL;
      $Ad->deleted_at = date('Y-m-d H:i:s');
      if($Ad->update()){
         $mailData['name']     = $Ad->user->name;
         $mailData['subject']  = 'Ad Deleted';
      if($Ad->user->lang == 'bn'){
         $mailData['hello']    = 'হ্যালো';
         $mailData['msg']  = 'আপনার বিজ্ঞাপন '.$Ad->title.' মুছে ফেলা হয়েছে';
      }else{
         $mailData['hello']   = 'Hello';
         $mailData['msg'] = 'your ad '.$Ad->title.' was deleted';
      }
         $status = 'your ad '.$Ad->title.' was deleted';
         $mailData['template'] = 'ad_deleted';
         $mailData['msg']   = $status;
         $mailData['to']    = $Ad->user->email; 
         $mailData['due']   = $request->reason; 
         if($Ad->user->email){
            try{
            \Mail::to($mailData['to'])->send(new NotifyMail($mailData));
            }catch(\Exception $e){
            }
         }

         try{
            DB::beginTransaction();
            DB::table('ads')->where('id',$Ad->id)->delete();
            DB::table('chats')->where('ad_id',$Ad->id)->delete();
            DB::table('ad_images')->where('ad_id',$Ad->id)->delete();
            DB::table('ad_values')->where('ad_id',$Ad->id)->delete();
            DB::table('favouriate_ads')->where('ad_id',$Ad->id)->delete();
            DB::table('report_ads')->where('ad_id',$Ad->id)->delete();
            DB::commit();
            $Ad->deleteImages();
         }catch(\Exception $e){
            DB::rollback();
         }
         return redirect()->route('admin.ads')->with('status',true)->with('message','Successfully deleted');
      }
   else{
         return redirect()->back()->with('status',false)->with('message','Failed to deleted');
   }
}

public function userDelete(Request $request){
   $this->authorize('delete', User::class);
   $user   = User::find($request->id);
   $email  = $user->email;
   $name   = $user->name;
   $user->delete_reason = $request->reason ?? '';
   $user->update();
   if($user->delete()){
      if($email){
         $mailData['template'] = 'account_delete';
         $mailData['name']     = $name;
         $mailData['subject']  = 'Account Deleted';
         $mailData['msg']   = 'Your account has been delete ';
         $mailData['to']    = $email; 
         $mailData['email'] = $email; 
         $mailData['due']   = $request->reason ?? ''; 
         try{
         \Mail::to($mailData['to'])->send(new NotifyMail($mailData));
         }catch(\Exception $e){
         }
      }

     return redirect()->back()->with('status',true)->with('message','User deleted successfully');
   }
     return redirect()->back()->with('status',false)->with('message','Failed to delete user');
 }

      public function userResetPassword(Request $request){
         $this->authorize('resetpassword', User::class);
         $user = User::find($request->id);
         $user->password = \Hash::make($request->password);
         if($user->update()){
         return redirect()->back()->with('status',true)->with('message','Password reset successfully');
         }
         return redirect()->back()->with('status',false)->with('message','Failed to reset password');
      }

}


