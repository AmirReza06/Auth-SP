<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed'
        ]);
//        dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->Password),
        ]);

        if (!$user){
            return redirect()->back()->with('error' , 'Register field,Trying for register please.');
        }
        else{
            return redirect()->route('home')->with('success' , 'Register Successful,Go to the login page please');
        }

    }

    public function login()
    {
        if (auth()->check()){
            redirect()->route('home');
        }
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:4'
        ]);

//        if (!Auth::attempt($credentials)){
//            $request->session()->regenerate();
//            redirect()->route('home');
//        }
//
//        return redirect()->back()->with('error' , 'The Password is mistake');

        $user = User::where('email' , $request->email)->first();
        if (!$user){
            return redirect()->route('auth.login')->with('error' , 'This Email was existing before');
        }

//        dd($request->password , $user->password);

        if (!Hash::check($request->password , $user->password)){
            return redirect()->back()->with('error' , 'The Password is mistake');
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('home')->with('success', 'Login done successfully');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');

    }
}
