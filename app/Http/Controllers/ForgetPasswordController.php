<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\Concerns\Has;
use function Laravel\Prompts\password;

class ForgetPasswordController extends Controller
{
    public function forgetPassword()
    {
        return view('auth.forget-password');
    }

    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $email = DB::table('password_reset_tokens')->where('email' , $request->email)->first();
        if ($email){
            return redirect()->back()->with('error', 'Password forgotten email has already been');
        }

        $token = str()->random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forget-password', ['token' => $token], function ($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return redirect()->back()->with('success', 'The Email send your email successfully');
    }


    public function resetPassword($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function resetPasswordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:4|confirmed'
        ]);

        $resetPassword = DB::table('password_reset_tokens')->where(['token' => $request->token])->first();
        if (!$resetPassword){
            return redirect()->back()->with('error', 'invalid data');
        }

        $user = User::where('email' , $resetPassword->email);
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_reset_tokens')->where(['token' => $request->token])->delete();

        return redirect()->route('login');
    }
}
