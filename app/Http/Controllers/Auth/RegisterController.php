<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\NotifyMail;
use Illuminate\Http\Request;
use Mail;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name'     => 'required|string|max:255',
            'email_address' => 'required|string|email|max:255|unique:users,email',
            'phone_number'  => 'required|min:10|max:10',
            'password'      => 'required|string|min:6|confirmed',
            'term_and_condition' => 'required'
        ],[
            'term_and_condition.required' => __('Please accept term & conditions')
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'          => $data['user_name'],
            'phone'         => $data['phone_number'],
            'email'         => $data['email_address'],
            "lang"          => $data['lang'] ?? 'en',
            "device_token"  => $data['device_token'] ?? '',
            'password' => Hash::make($data['password'])
        ]);

         
    }

     /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $User)
    {
            // $mailData['name']     = $User->name;
            // $mailData['url']      = route('email.varification',encrypt($User->id));
            // $mailData['subject']  = 'Email Varification';
            // $mailData['template'] = 'email_varification';
            // $mailData['to']       = $User->email; 
          //  Mail::to($user->email)->send(new NotifyMail($mailData));
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
          //  Auth::logout();
            return redirect()->route('registration.success')->with('status','success')->with('message','A verification link has been sent to your given email address');
    }
}
