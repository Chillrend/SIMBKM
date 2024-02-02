<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\User;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $client = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));

        $response = $client->get("/jurusan/all")->getBody()->getContents();
        $fakultas = collect(json_decode($response, true));
        $fakultas = $fakultas->map(function ($fakulta) use ($client) {
            return (object)$fakulta;
        });

        $response = $client->get("/prodi/all")->getBody()->getContents();
        $jurusans = collect(json_decode($response, true));
        $jurusans = $jurusans->map(function ($jurusan) use ($client) {
            return (object)($jurusan);
        });

        return view('dashboard.register', [
            'title'      => 'Buat Akun',
            'title_page' => 'Buat Akun',
            'name'       => auth()->user()->name,
            'active'     => 'Buat Akun',
            'roles'      => Role::all(),
            'fakultas'   => $fakultas,
            'jurusan'    => $jurusans,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'            => 'required|max:255',
            'email'           => 'required|unique:users|email',
            'password'        => 'required|min:5|max:255',
            'role'            => 'required',
            'additional_role' => 'nullable',
            'api_jurusan_id'  => 'required',
            'api_prodi_id'    => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        session()->flash('success', 'Registration successfull!');

        return redirect('/dashboard/register');
    }

    public function editUser($id)
    {
        $client = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));

        $response = $client->get("/jurusan/all")->getBody()->getContents();
        $fakultas = collect(json_decode($response, true));
        $fakultas = $fakultas->map(function ($fakulta) use ($client) {
            return (object)$fakulta;
        });

        $response = $client->get("/prodi/all")->getBody()->getContents();
        $jurusans = collect(json_decode($response, true));
        $jurusans = $jurusans->map(function ($jurusan) use ($client) {
            return (object)($jurusan);
        });

        return view('dashboard.edit-akun', [
            'title'      => 'Edit Akun',
            'title_page' => 'Edit Akun',
            'name'       => auth()->user()->name,
            'active'     => 'Edit Akun',
            'user'       => User::find($id),
            'roles'      => Role::all(),
            'fakultas'   => $fakultas,
            'jurusans'   => $jurusans,
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        $validatedData = $request->validate([
            'name'            => 'required|max:255',
            'email'           => 'required|email',
            'password'        => 'required|min:5|max:255',
            'role'            => 'required',
            'additional_role' => 'nullable',
            'api_jurusan_id'  => 'required',
            'api_prodi_id'    => 'required',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        if ($user->email !== $validatedData['email']) {
            if (User::where('email', $validatedData['email'])->exists()) {
                return redirect()->back()->withErrors(['email' => 'The email address is already in use.']);
            }
        }

        $user->update($validatedData);

        session()->flash('success', 'Edit account successfull!');

        return redirect('/dashboard/register/kelola-akun/');
    }

    public function deleteUser($id)
    {
        User::destroy($id);

        session()->flash('success', 'Account successfully removed!');

        return redirect('/dashboard/register/kelola-akun/');
    }

    public function kelolaAkun()
    {
        $client = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));

        $users = User::latest()->get()->map(function (User $user) use ($client) {
            if ($user->api_jurusan_id) {
                $response = $client->get("/jurusan/find/" . $user->api_jurusan_id)->getBody()->getContents();
                $fakultas = (object) json_decode($response, true);
                $user->fakultas = $fakultas->nama_jurusan;
            }
            if ($user->api_prodi_id) {
                $response = $client->get("/prodi/find/" . $user->api_prodi_id)->getBody()->getContents();
                $jurusan  = (object) json_decode($response, true);
                $user->jurusan = $jurusan->nama_prodi;
            }

            return $user;
        });

        return view('dashboard.kelola-akun', [
            'title'      => 'Buat Akun / Kelola Akun',
            'title_page' => 'Buat Akun',
            'name'       => auth()->user()->name,
            'active'     => 'Buat Akun',
            'users'      => $users,
        ]);
    }
}
