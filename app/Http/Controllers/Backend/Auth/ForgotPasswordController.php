<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use \Illuminate\Auth\Passwords\PasswordBroker;
use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    { 
        return view('backend.auth.passwords.email');
    }

      public function sendResetLinkEmail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if( ! $validator->fails() )
        {
            if( $user = User::where('email', $request->input('email') )->first() )
            {
                
                $token = app(PasswordBroker::class)->createToken($user);
                $email = $user->email;

                $message = array('url' => url('admin/password/reset/'.$token));
                Mail::send('backend.mails.forgot_password',$message ,function($message) use($email)
                {
                    $message
                    ->to($email)
                    ->from('test.developer124@gmail.com')
                    ->subject('Forgot Password');
                });

                return redirect()->back()->with('status', trans(Password::RESET_LINK_SENT));
            }
        }
        
        return redirect()->back()->withErrors(['email' => trans(Password::INVALID_USER)]); 
   }

}
