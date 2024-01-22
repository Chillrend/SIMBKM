<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\User;
use App\Models\SSOUser;
use App\Models\Fakultas;
use App\Models\ProgramMbkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DepartementAndLevel;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginSSOController extends Controller
{

    public function redirectToSSOPNJ(){
        return Socialite::driver('pnj')->redirect();
    }

    public function callback(){
        $user = Socialite::driver('pnj')->user();

        // Check if they're an existing user DIRECTLY via user table
        $existingUserFromUser = User::where('email', $user->attributes['email'])->first();

        if($existingUserFromUser){
            Auth::login($existingUserFromUser);
            request()->session()->regenerate();

            return redirect()->intended('/dashboard/index');
        } else {
            $client = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));

            $users_details = null;

            //Default role for Mahasiswa
            $role = 7;

            if($user->attributes['department_and_level'][0]["access_level_name"] == "Mahasiswa"){
                $users_details = $client->get('/mahasiswa/nim/'. $user->attributes['ident']);
            }else if ($user->attributes['department_and_level'][0]["access_level_name"] == "Dosen"){
                $role = 4;
                $users_details = $client->get('/dosen/nim/'. $user->attributes['ident']);
            }

            if($users_details == null || $users_details->getStatusCode() == 404){
                return response()->json(['error' => 'Akun Anda tidak dapat digunakan untuk mendaftar MBKM, mohon hubungi Admin untuk daftar']);
            }

            $user_details_response = json_decode($users_details->getBody()->getContents());

            $newUserLogin = User::create([
                'name' => ucwords(strtolower($user->attributes['name'])),
                'email' => $user->attributes['email'],
                'nim' => $user->attributes['ident'],
                'api_prodi_id' => $user_details_response->id_program_studi ? : null,
                'role' => $role
            ]);

            Auth::login($newUserLogin, true);
            request()->session()->regenerate();

            return redirect()->intended('/dashboard');
        }
    }
}
