<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function ForgetPassword() {
        return view('auth.forget-password');
    }

    public function ForgetPasswordStore(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.forget-password-email', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have emailed your password reset link!');
    }

    public function ResetPassword($token) {
        return view('auth.forget-password-link', ['token' => $token]);
    }
    
    public function ResetPasswordStore(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $update = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();

        if(!$update){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        // Delete password_resets record
        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login-page')->with('message', 'Your password has been successfully changed!');
    }
}
