<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\Mbkm;
use App\Models\ProgramMbkm;
use App\Models\Laporan;
use App\Models\Logbook;
use App\Models\LogLogbook;
use App\Models\LogSignaturePdf;

class WadirController extends Controller
{
    public function dashboard()
    {
        $fakultas = request('fakultas');

        $client = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));

        $response = $client->get("/jurusan/all")->getBody()->getContents();
        $fakultas = collect(json_decode($response, true));
        $fakultas = $fakultas->map(function ($fakulta) use ($client) {
            return (object)([
                'id'           => $fakulta['id'],
                'nama_jurusan' => $fakulta['nama_jurusan'],
            ]);
        });

        $response = $client->get("/prodi/all")->getBody()->getContents();
        $jurusans = collect(json_decode($response, true));
        $jurusans = $jurusans->map(function ($jurusan) use ($client) {
            return (object)([
                'id'         => $jurusan['id'],
                'nama_prodi' => $jurusan['nama_prodi'],
                'id_jurusan' => $jurusan['id_jurusan'],
            ]);
        });


//      AMBIL PROGRAM MBKM DARI MBKM
        $data = ProgramMbkm::withCount('mbkms')->groupBy('name')->get()->map(function ($program) {
            return [
                'label' => $program->name,
                'total' => $program->mbkms_count,
            ];
        });

        $mbkmsMhsw = Mbkm::with('namaUser')->get()->map(function (Mbkm $mbkm) {
            return [
                'jurusan' => $mbkm->namaUser->api_jurusan_id,
                'prodi'   => $mbkm->namaUser->api_prodi_id,
            ];
        })->toArray();


//        NGAMBIL DATA COUNT FAKULTASI DARI MBKM
        // count jurusan id
        $data1 = array_count_values(array_column($mbkmsMhsw, 'jurusan'));

        $data1 = $fakultas->map(function ($jurusan) use ($mbkmsMhsw, $data1) {
            return [
                'id'      => $jurusan->id,
                'jurusan' => $jurusan->nama_jurusan,
                'total'   => $data1[$jurusan->id] ?? 0,
            ];
        });

//      NGAMBIL DATA COUNT JURUSAN DAN FAKULTASI MBKM, TRUS DIURUTIN FAKULTASI BARU JURUSAN
        $data2 = array_count_values(array_column($mbkmsMhsw, 'prodi'));

        $data2 = $jurusans->map(function ($prodi) use ($mbkmsMhsw, $data2, $fakultas) {
            $fakulta = $fakultas->filter(function ($fakulta) use ($prodi) {
                return $fakulta->id == $prodi->id_jurusan;
            });

            return [
                'id'            => $prodi->id,
                'program_studi' => $prodi->nama_prodi,
                'jurusan'       => (collect($fakulta)->first()) ? $fakulta->first()->nama_jurusan : null,
                'total'         => $data2[$prodi->id] ?? 0,
            ];
        });

        return view('dashboard.wadir.dashboard', [
            'active'     => 'Dashboard Wadir',
            'title_page' => 'Dashboard',
            'title'      => 'Dashboard',
            'fakultas'   => $fakultas,
            'mahasiswa'  => Mbkm::latest()->filter(request(['search']))
                ->paginate(7)->withQueryString(),
            'jumlahData' => [$data, $data1, $data2]
        ]);
    }

    public function detailMahasiswa($id)
    {
        return view('dashboard.wadir.detail-mahasiswa', [
            'active'     => 'Dashboard Wadir',
            'title_page' => 'Dashboard / Detail Mahasiswa',
            'title'      => 'Dashboard',
            'laporan'    => Laporan::where('id', $id)->with('listMbkm')->get()
        ]);
    }

    public function logbookMahasiswa($id)
    {
        $logbook     = Logbook::with('listMbkm')->where('mbkm', $id)->get();
        $log_logbook = LogLogbook::where('logbook', $logbook[0]->id)->get();
        return view('dashboard.wadir.logbook-mahasiswa', [
            'title'       => 'Dashboard',
            'title_page'  => 'Dashboard / Detail Mahasiswa / Logbook',
            'active'      => 'Dashboard Wadir',
            'owner'       => $logbook[0]->name,
            'log_logbook' => $log_logbook,
        ]);
    }

    public function detailLogbook($id)
    {
        $logbook = LogLogbook::with('listOwner')->where('id', $id)->get();
        return view('dashboard.wadir.detail-logbook', [
            'title'      => 'Dashboard',
            'title_page' => 'Dashboard / Detail Mahasiswa / Logbook / Detail',
            'active'     => 'Dashboard Wadir',
            'logbook'    => $logbook
        ]);
    }

    public function viewPdf($id)
    {
        // $test = LogSignaturePdf::where('laporan_id', $id)->get();
        return view('dashboard.wadir.view-pdf', [
            'laporan'   => Laporan::find($id)->get(),
            'signature' => LogSignaturePdf::where('laporan_id', $id)->get()
        ]);
    }
}
