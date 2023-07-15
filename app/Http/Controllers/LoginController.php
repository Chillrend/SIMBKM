<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Mbkm;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;
use App\Http\Controllers\Controller;
// use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


class LoginController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function index(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            // 'email' => 'required|email:dns',
            'email' => 'required|email', 
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/index');
        }
        return back()->with('loginError', 'Login failed!');
    }

    public function logout(){
        Auth::logout();
 
        request()->session()->invalidate();
     
        request()->session()->regenerateToken();
     
        return redirect('/');
    }

    public function forgotPassword(){
        return view('forgot-password');
    }

    public function submitForgotPasswordForm(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        $token = Str::random(64);

        $name = User::where('email', $request->email)->get();

        $device = Agent::platform();
        $version = Agent::version($device);
        $browser = Agent::browser();

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('email.forgetPassword',
        ['token' => $token,
         'name' => $name[0]->name, 
         'device' => $device, 
         'version' => $version, 
         'browser' => $browser], 
        function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token){
        $account = DB::table('password_reset_tokens')
                    ->where('token', $token)
                    ->first();

        return view('reset-password', [
            'token' => $token,
            'email' => $account->email
        ]);
    }

    public function submitResetPasswordForm(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
                            ->where([
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('success', 'Your password has been changed!');
    }

    public function exportExcel(){
        return Excel::download(new MahasiswaExport, 'data-mahasiswa.xlsx');
    }

}
