<?php

namespace App\Http\Controllers;

use App\Models\CommentKonversi;
use App\Models\CommentLaporan;
use App\Models\Laporan;
use App\Models\ProgramMbkm;
use App\Models\TahunAjaranMbkm;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // public function index(){
    //     return view('dashboard.forum', [
    //         'title' => 'Dashboard',
    //         'active' => 'dashboard'
    //     ]);
    // }

    public function pendaftaranMBKM()
    {

        return view('dashboard.informasi-mbkm', [
            'title' => 'Pendaftaran MBKM',
            'title_page' => 'Informasi MBKM',
            'active' => 'Informasi MBKM',
            'name' => auth()->user()->name,
            'programs' => ProgramMbkm::where('status', 'Aktif')->get(),
            'tahun_ajaran' => TahunAjaranMbkm::all()->sortByDesc('id'),
            'dosbing' => User::where(function ($query) {
                $query->where('role', '4')->orWhere('additional_role', '4');
            })->where('api_prodi_id', auth()->user()->api_prodi_id)->get(),
            'pembimbing_industri' => User::where('role', '6')->orWhere('additional_role', '6')->get(),
            'mbkm' => Laporan::where('owner', auth()->user()->id)->latest()->limit(1)->get()

        ]);
    }

    public function uploadKurikulum()
    {
        return view('dashboard.upload-kurikulum', [
            'title' => 'Upload Kurikulum',
            'title_page' => 'Upload Kurikulum',
            'active' => 'Upload Kurikulum',
            'name' => auth()->user()->name
        ]);
    }

    public function hasilKonversi()
    {
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


    public function createLogbook()
    {
        return view('dashboard.create-logbook', [
            'title' => 'Logbook',
            'title_page' => 'Hasil Logbook',
            'active' => 'Logbook',
            'name' => auth()->user()->name
        ]);
    }

    public function laporan()
    {
        return view('dashboard.laporan', [
            'title' => 'Laporan',
            'title_page' => 'Laporan',
            'active' => 'Laporan',
            'name' => auth()->user()->name,
            'laporans' => CommentLaporan::with('dataLaporan')->where('user', auth()->user()->id)->get()
        ]);
    }

    public function welcome()
    {
        $auth = auth()->user();

        return view('dashboard.welcome', [
            'title' => 'welcome',
            'title_page' => 'Dashboard',
            'active' => '',
            'name' => auth()->user()->name
        ]);
    }

}
