<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('dashboard.register',[
            'title' => 'Buat Akun',
            'title_page' => 'Buat Akun',
            'name' => auth()->user()->name,
            'active' => 'Buat Akun',
            'roles' => Role::all(),
            'fakultas' => Fakultas::all(),
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5|max:255',
            'role' => 'required',
            'role_kedua' => 'nullable',
            'role_ketiga' => 'nullable',
            'fakultas_id' => 'required',
            'jurusan_id' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        session()->flash('success', 'Registration successfull!');

        return redirect('/dashboard/register');
    }

    public function editUser($id) {

        return view('dashboard.edit-user', [
            'title' => 'Edit Akun',
            'title_page' => 'Edit Akun',
            'name' => auth()->user()->name,
            'active' => 'Edit Akun',
            'user' => User::find($id),
        ]);
    }

    public function updateUser(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5|max:255',
            'role' => 'required',
            'role_kedua' => 'nullable',
            'role_ketiga' => 'nullable',
            'fakultas_id' => 'required',
            'jurusan_id' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::find($id);

        $user::update($validatedData);

        session()->flash('success', 'Edit account successfull!');
        
        return redirect('/dashboard/register/');
    }

    public function removeUser($id) {
        User::destroy($id);

        session()->flash('success', 'Edit account successfull!');

        return redirect('/dashboard/register/kelola-akun/');
    }

    public function kelolaAkun(){
        return view('dashboard.kelola-akun', [
            'title' => 'Buat Akun / Kelola Akun',
            'title_page' => 'Buat Akun',
            'name' => auth()->user()->name,
            'active' => 'Buat Akun',
            'users' => User::latest()->get()
        ]);
    }
}
