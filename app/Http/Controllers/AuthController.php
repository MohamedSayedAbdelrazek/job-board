<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function showSignupForm()
    {
        return view('auth.signup',['pageTitle'=>'signup']);
    }

    public function signup(SignupRequest $request)
    {
        $user=new User();   

        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=$request->input('password');
        $user->save();

        Auth::login($user);
       
        return redirect()->route('posts.index');
        //@TODO:handle POST request
    }

    public function showLoginForm()
    {
        return view('auth.login',['pageTitle'=>'login']);
    }

    public function login(LoginRequest $request)
    {
        $credentials=$request->only('email','password');

        if(!Auth::attempt($credentials))
        {
            return redirect()->back()->withErrors([
                'email'=>"The email or password is incorrect"
            ])->withInput();
        }
        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
