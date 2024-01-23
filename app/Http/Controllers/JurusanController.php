<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Fakultas;

class JurusanController extends Controller
{
    public function index()
    {
        $client = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));

        $prodis = $client->get('/prodi/all')->getBody()->getContents();
        $prodis = collect(json_decode($prodis));

        $prodis = $prodis->map(function ($prodi) use ($client) {
            $array = (object)($prodi);

            if ($prodi->id_jurusan) {
                $jurusan      = $client->get('/jurusan/find/' . $prodi->id_jurusan)->getBody()->getContents();
                $jurusan      = (object)json_decode($jurusan);
                $nama_jurusan = $jurusan->nama_jurusan;
            } else {
                $nama_jurusan = '-';
            }
            $array->nama_jurusan = $nama_jurusan;

            return $array;
        });

        return view('dashboard.jurusan', [
            'title'      => 'Prodi',
            'title_page' => 'Prodi',
            'active'     => 'Jurusan',
            'name'       => auth()->user()->name,
            'jurusan'    => $prodis,
        ]);
    }

    public function create()
    {
        return view('dashboard.create-jurusan', [
            'title'      => 'Create',
            'title_page' => 'Prodi / Create',
            'active'     => 'Jurusan',
            'name'       => auth()->user()->name,
            'fakultas'   => Fakultas::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'        => 'required|unique:jurusan',
            'fakultas_id' => 'required',
            'status'      => 'required'
        ]);
        Jurusan::create($validatedData);

        return redirect('/dashboard/jurusan')->with('success', 'Prodi Berhasil Dibuat!');
    }

    public function edit($id)
    {
        return view('dashboard.edit-jurusan', [
            'title'      => 'Edit',
            'title_page' => 'Prodi / Edit',
            'active'     => 'Jurusan',
            'name'       => auth()->user()->name,
            'jurusan'    => Jurusan::find($id),
            'fakultas'   => Fakultas::all()
        ]);
    }

    public function update(Request $request, $jurusan)
    {

        $postingan = Jurusan::find($jurusan);

        $postingan->update($request->all());
        return redirect('/dashboard/jurusan')->with('success', 'Data Prodi has been updated!');

    }

    public function destroy($id)
    {
        Jurusan::destroy($id);
        return redirect('/dashboard/jurusan')->with('success', 'Data Prodi Berhasil di Hapus');
    }
}
