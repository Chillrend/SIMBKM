<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;

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
}
