<?php

namespace App\Http\Controllers;

use App\Models\Mbkm;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Laporan;
use App\Models\Logbook;
use App\Models\LogLogbook;
use App\Models\ProgramMbkm;
use Illuminate\Http\Request;
use App\Models\LogSignaturePdf;
use Illuminate\Support\Facades\DB;

class PembimbingAkademikController extends Controller
{
    public function dashboard(){
        
        $data = DB::select('SELECT pm.name as label, count(pm.name) as total FROM 
        mbkms m left join program_mbkms pm on pm.id=m.program GROUP BY pm.name');
        
        return view('dashboard.pembimbing-akademik.dashboard', [
            'active' => 'Dashboard Pembimbing Akademik',
            'title_page' => 'Dashboard',
            'title' => 'Dashboard',
            'mahasiswa' => Mbkm::latest()->filter(request(['search']))
            ->paginate(10)->withQueryString(),
            'jumlahData' => $data
        ]);
    }

    public function fetchJurusan(Request $request){
        $data['jurusan'] = Jurusan::where("fakultas_id", $request->fakultas_id)
                            ->where('status', '=' , 'Aktif')
                            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function detailMahasiswa($id){
        return view('dashboard.pembimbing-akademik.detail-mahasiswa', [
            'active' => 'Dashboard Pembimbing Akademik',
            'title_page' => 'Dashboard / Detail Mahasiswa',
            'title' => 'Dashboard',
            'laporan' => Laporan::where('id', $id)->with('listMbkm')->get()
        ]);
    }

    public function logbookMahasiswa($id){
        $logbook = Logbook::with('listMbkm')->where('mbkm', $id)->get();
        $log_logbook = LogLogbook::where('logbook', $logbook[0]->id)->get();
        return view('dashboard.pembimbing-akademik.logbook-mahasiswa', [
            'title' => 'Dashboard',
            'title_page' => 'Dashboard / Detail Mahasiswa / Logbook',
            'active' => 'Dashboard Pembimbing Akademik',
            'owner' =>  $logbook[0]->name,
            'log_logbook' => $log_logbook,
        ]);
    }

    public function detailLogbook($id){
        $logbook = LogLogbook::with('listOwner')->where('id', $id)->get();
        return view('dashboard.pembimbing-akademik.detail-logbook', [
            'title' => 'Dashboard',
            'title_page' => 'Dashboard / Detail Mahasiswa / Logbook / Detail',
            'active' => 'Dashboard Pembimbing Akademik',
            'logbook' => $logbook
        ]);
    }

    public function viewPdf($id){
        return view('dashboard.pembimbing-akademik.view-pdf',[
            'laporan' => Laporan::find($id)->get(),
            'signature' => LogSignaturePdf::where('laporan_id', $id)->get()
        ]);
    }
}
