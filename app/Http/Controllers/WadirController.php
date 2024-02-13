<?php

namespace App\Http\Controllers;

use App\Models\Mbkm;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Logbook;
use App\Models\LogLogbook;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Models\LogSignaturePdf;
use Illuminate\Support\Facades\DB;

class WadirController extends Controller
{
    public function dashboard(){
        $fakultas = request('fakultas');
        $data = DB::select('SELECT pm.name as label, count(pm.name) as total
        FROM mbkms m
        LEFT JOIN program_mbkms pm on pm.id=m.program
        GROUP BY pm.name;');

$data1 = DB::select("SELECT f.name AS jurusan, COUNT(f.name) AS total
FROM mbkms m
LEFT JOIN fakultas f ON f.id = m.fakultas
GROUP BY f.name");

$data2 = DB::select("SELECT j.name AS program_studi, f.name AS jurusan ,COUNT(j.name) AS total
FROM mbkms m
LEFT JOIN fakultas f ON f.id = m.fakultas
LEFT JOIN jurusan j ON j.id = m.jurusan
GROUP BY f.name, j.name");


// dd($data, $data1, $data2);


        return view('dashboard.wadir.dashboard', [
            'active' => 'Dashboard Wadir',
            'title_page' => 'Dashboard',
            'title' => 'Dashboard',
            'fakultas' => Fakultas::where('status', 'Aktif')->get(),
            'mahasiswa' => Mbkm::latest()->filter(request(['search']))
            ->paginate(7)->withQueryString(),
            'jumlahData' => [$data,$data1,$data2]
        ]);
    }

    public function detailMahasiswa($id){
        return view('dashboard.wadir.detail-mahasiswa', [
            'active' => 'Dashboard Wadir',
            'title_page' => 'Dashboard / Detail Mahasiswa',
            'title' => 'Dashboard',       
            'laporan' => Laporan::where('id', $id)->with('listMbkm')->get()
        ]);
    }

    public function logbookMahasiswa($id){
        $logbook = Logbook::with('listMbkm')->where('mbkm', $id)->get();
        $log_logbook = LogLogbook::where('logbook', $logbook[0]->id)->get();
        return view('dashboard.wadir.logbook-mahasiswa',[
            'title' => 'Dashboard',
            'title_page' => 'Dashboard / Detail Mahasiswa / Logbook',
            'active' => 'Dashboard Wadir',
            'owner' =>  $logbook[0]->name,
            'log_logbook' => $log_logbook,
        ]);
    }

    public function detailLogbook($id){
        $logbook = LogLogbook::with('listOwner')->where('id', $id)->get();
        return view('dashboard.wadir.detail-logbook', [
            'title' => 'Dashboard',
            'title_page' => 'Dashboard / Detail Mahasiswa / Logbook / Detail',
            'active' => 'Dashboard Wadir',
            'logbook' => $logbook
        ]);
    }

    public function viewPdf($id){
        // $test = LogSignaturePdf::where('laporan_id', $id)->get();
        return view('dashboard.wadir.view-pdf',[
            'laporan' => Laporan::find($id)->get(),
            'signature' => LogSignaturePdf::where('laporan_id', $id)->get()
        ]);
    }
}
