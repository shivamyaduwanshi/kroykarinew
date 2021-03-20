<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\User;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->is_active != '1'){
            Auth::logout();
            return redirect()->route('login')->with('status',true)->with('message',__('Your account is inactived,Pleaser contact your administrater'));
        }

        if($user->is_varify_email != '1'){
            Auth::logout();
            return redirect()->route('login')->with('status',true)->with('message',__('Your email is not verified yet,Please verify  your email'));
        }

        $User = User::find($user->id);
        $User->device_type  = 'web';
        $User->device_token = $request->device_token ?? '';
        $User->update();

    }

     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
        public function redirectToProvider()
        {
            return Socialite::driver('facebook')->redirect();
        }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
        public function handleProviderCallback()
        {
             try{
                 $facebookData = Socialite::driver('facebook')->stateless()->user();
              //   $file = str_random('10').'.'.time() . '.png';
              //   file_put_contents('public/images/profile/' . $file,file_get_contents($facebookData->avatar));            
                 $User = User::where('social_id',$facebookData->id)->whereNull('deleted_at')->first();
                 if(empty($User) || is_null($User)){
                     $User = new User;
                     $User->social_id = $facebookData->id;
                 }
                 $User->name  = $facebookData->name;
                 $User->email = $facebookData->email;
               //  $User->profile_image = $file;
                 $User->login_by  = 'facebook';
                 $User->save();
                 Auth::login($User);
                 return Redirect::intended();        
             }catch(\Exception $e){
                return redirect('back')->with('status',false)->with('message',__('Failed to login'));
             }
        }

}
