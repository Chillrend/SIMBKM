<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Fakultas;
use App\Models\ProgramMbkm;
use App\Models\Laporan;
use App\Models\CommentLaporan;
use Illuminate\Http\Request;
use App\Models\HasilKonversi;
use App\Models\CommentKonversi;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class DashboardController extends Controller
{
    // public function index(){
    //     return view('dashboard.forum', [
    //         'title' => 'Dashboard',
    //         'active' => 'dashboard'
    //     ]);
    // }


    public function fetchJurusan(Request $request){
        $data['jurusan'] = Jurusan::where("fakultas_id", $request->fakultas_id)
                            ->where('status', '=' , 'Aktif')
                            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function pendaftaranMBKM(){
        // $test = Laporan::where('owner', auth()->user()->id)->get();
        // dd($test->count());
        
        return view('dashboard.informasi-mbkm', [
            'title' => 'Pendaftaran MBKM',
            'title_page' => 'Informasi MBKM',
            'active' => 'Informasi MBKM',
            'name' => auth()->user()->name,
            'fakultas' => Fakultas::where('status', 'Aktif')->get(),
            'programs' => ProgramMbkm::where('status', 'Aktif')->get(),
            'dosbing' => User::where('role', '4')->orWhere('role_kedua', '4')->orWhere('role_ketiga', '4')->get(),
            'pembimbing_industri' => User::where('role', '6')->orWhere('role_kedua', '6')->orWhere('role_ketiga', '6')->get(),
            'mbkm' => Laporan::where('owner', auth()->user()->id)->latest()->limit(1)->get()

        ]);
    }

    public function uploadKurikulum(){
        return view('dashboard.upload-kurikulum', [
            'title' => 'Upload Kurikulum',
            'title_page' => 'Upload Kurikulum',
            'active' => 'Upload Kurikulum',
            'name' => auth()->user()->name
        ]);
    }

    public function hasilKonversi(){
        $idKonversi = DB::table('hasil_konversis')
                            ->select('id')
                            ->where('owner', '=', auth()->user()->id)
                            ->orderByDesc('id')
                            ->limit(1)
                            ->get();
        // dd($data);


        return view('dashboard.hasil-konversi', [
            'title' => 'Hasil Konversi',
            'title_page' => 'Hasil Konversi',
            'active' => 'Hasil Konversi',
            'name' => auth()->user()->name,
            'hasil' => CommentKonversi::with('dataHasilKonversi')->where('owner', auth()->user()->id)->latest()->get(),
        ]);
    }


    public function createLogbook(){
        return view('dashboard.create-logbook',[
            'title' => 'Logbook',
            'title_page' => 'Hasil Logbook',
            'active' => 'Logbook',
            'name' => auth()->user()->name
        ]);
    }

    public function laporan(){
        return view('dashboard.laporan', [
            'title' => 'Laporan',
            'title_page' => 'Laporan',
            'active' => 'Laporan',
            'name' => auth()->user()->name,
            'laporans' => CommentLaporan::with('dataLaporan')->where('user', auth()->user()->id)->get()
        ]);
    }

    public function welcome(){
        $auth = auth()->user();

        if(is_null($auth->jurusan_id) || empty($auth->jurusan_id) ){
            if(is_null($auth->sso_pnj) || empty($auth->sso_pnj)){
                return redirect()->intended('/dashboard/first-create/0');
            }else{
                return redirect()->intended('/dashboard/first-create/1');
            }
        }

        return view('dashboard.welcome', [
            'title' => 'welcome',
            'title_page' => 'Dashboard',
            'active' => '',
            'name' => auth()->user()->name
        ]);
    }

}
