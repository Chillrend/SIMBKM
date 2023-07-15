<?php

namespace App\Http\Controllers;

use App\Models\Mbkm;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Logbook;
use App\Models\LogLogbook;
use Illuminate\Http\Request;
use App\Models\CommentLaporan;
use Illuminate\Support\Facades\Storage;

class PembimbingIndustriController extends Controller
{
    public function dashboard(){
        $mbkm = Mbkm::where('pembimbing_industri', auth()->user()->id)->distinct()->get();
        $user = '';

        if(empty($mbkm)){
            $user = User::where('email', $mbkm[0]->email)->get();
        }else{
            $user = $mbkm;
        }

        return view('dashboard.pembimbing-industri.dashboard',[
            'title' => 'Dashboard',
            'title_page' => 'Dashboard',
            'active' => 'Dashboard Pembimbing Industri',
            'name' => auth()->user()->name,
            'mahasiswa' => $user
        ]);
    }

    public function detailMahasiswa($id){
        return view('dashboard.pembimbing-industri.detail-mahasiswa', [
            'title' => 'Dashboard',
            'title_page' => 'Dashboard / Detail Mahasiswa',
            'active' => 'Dashboard Dosbing',
            'laporan' => Laporan::where('mbkm', $id)->with('listMbkm')->get()
        ]);
    }

    public function logbook(){
        $mbkm = Mbkm::where('pembimbing_industri', auth()->user()->id)->get();
        $user = '';

        if(empty($mbkm)){
            $user = User::where('email', $mbkm[0]->email)->get();
        }else{
            $user = $mbkm;
        }
        return view('dashboard.pembimbing-industri.logbook', [
            'title' => 'Logbook',
            'title_page' => 'Logbook',
            'active' => 'Logbook Pembimbing Industri',
            'name' => auth()->user()->name,
            'mahasiswa' => $user
        ]);
    }

    public function detailLogbook($id){
        $logbook = Logbook::with('listMbkm')->where('mbkm', $id)->get();
        // dd($logbook);
        $log_logbook = LogLogbook::where('logbook', $logbook[0]->id)->get();
        // dd($log_logbook);
        return view('dashboard.pembimbing-industri.detail-logbook',[
            'title' => 'Logbook',
            'title_page' => 'Logbook / Mahasiswa',
            'active' => 'Logbook Pembimbing Industri',
            'name' => auth()->user()->name,
            'owner' =>  $logbook[0]->name,
            'log_logbook' => $log_logbook,
        ]);
    }

    public function logLogbook($id){
        // $logbook = LogLogbook::find($id);
        $logbook = LogLogbook::with('listOwner')->where('id', $id)->get();
        // dd($logbook);
        return view('dashboard.pembimbing-industri.log-logbook',[
            'title' => 'Logbook',
            'title_page' => 'Logbook / Mahasiswa / Detail',
            'active' => 'Logbook Pembimbing Industri',
            'logbook' => $logbook
        ]);
    }

    public function logbookFinish($id){
        $log_logbook = LogLogbook::find($id);
        $log_logbook['status_pi'] = '1';
        $log_logbook->update();

        $logbook = Logbook::find($log_logbook->logbook);
        $mbkm = Mbkm::find($logbook->mbkm);
        // dd($mbkm->id);
        
        return redirect('/logbook/pi/detail/'.$mbkm->id)->with('success', 'Logbook Mahasiswa sudah dibaca');
    }

    public function laporan(){
        $mbkm = Mbkm::where('pembimbing_industri', auth()->user()->id)->get();
        $user = '';
        if(empty($mbkm)){
            $user = User::where('email', $mbkm[0]->email)->get();
        }else{
            $user = $mbkm;
        }
        
        return view('dashboard.pembimbing-industri.laporan',[
            'title' => 'Laporan',
            'title_page' => 'Laporan',
            'active' => 'Laporan Pembimbing Industri',
            'name' => auth()->user()->name,
            'mahasiswa' => $user
        ]);
    }

    public function listLaporan($id){
        return view('dashboard.pembimbing-industri.list-laporan', [
            'title' => 'List Laporan',
            'title_page' => 'Laporan / List Laporan',
            'active' => 'Laporan Pembimbing Industri',
            'laporans' => CommentLaporan::with('dataLaporan')->where('user', $id)->get()
        ]);
    }

    public function detailLaporan($id){
        $test = Laporan::find($id)->with('listMbkm')->get();
        return view('dashboard.pembimbing-industri.detail-laporan', [
            'title' => 'Laporan',
            'title_page' => 'Laporan / Detail',
            'active' => 'Laporan Pembimbing Industri',
            'laporan' => Laporan::find($id)->with('listMbkm')->get(),
            'logcomment' => CommentLaporan::all()->where('laporan', $id)
        ]);
    }

    public function signPdf($id){
        return view('dashboard.pembimbing-industri.sign-pdf',[
            'laporan' => Laporan::find($id)->get()
        ]);
    }

    public function savePdf(Request $request){
        Storage::makeDirectory('dokumen-annotate');
        $data = json_decode($request->file, true);
        Storage::put('dokumen-annotate/'.$request->name.'.json', json_encode($data));

        $rules['json_annotate'] = 'dokumen-annotate/'.$request->name.'.json';
        $rules['sign_third'] = '1';

        $pdf = Laporan::find($request->fileId);
        $pdf->update($rules);

        return $pdf;
    }
}
