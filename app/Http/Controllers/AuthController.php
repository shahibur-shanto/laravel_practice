<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validate
        $fields = $request->validate([
           'username'=>['required', 'max:255',],
            'email'=>['required','max:255','email','unique:users'],
            'password'=>['required', 'min:4','confirmed'],
        ]);

        //Register
          $user =   User::create($fields);



        //Login
        Auth::login($user);

        event(new Registered($user));
        //Redirect
        return redirect()->route('dashboard');

    }

    public function verifyNotice() {
        return view('auth.verify-email');
    }
    public function verifyEmail(EmailVerificationRequest $request) {
            $request->fulfill();

            return redirect()->route('dashboard');

    }

    public function verifyHandler (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
}


    //Login User
    public function login(Request $request ){
        //Validate
        $fields = $request->validate([
            'email'=>['required','max:255','email'],
            'password'=>['required'],
        ]);


        //Try to Log in

        if(Auth::attempt($fields, request()->remember)){
            //return where user are before login
            return redirect()->intended('dashboard');
            //return redirect()->route('home');
        }else{
            return back()->withErrors([
                'failed'=>'The Provided information is not match our record',

            ]);
        }
    }


    //Logout User
    public function logout(Request $request){

        //Logout The User
        Auth::logout();

        //Make session invalid
        $request->session()->invalidate();

        //Regenerate CSRF Token
        $request->session()->regenerateToken();

        //Redirect Home Page
        return redirect(route('posts.index'));
    }
}
