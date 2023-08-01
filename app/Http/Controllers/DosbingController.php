<?php

namespace App\Http\Controllers;

use App\Models\Mbkm;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Logbook;
use App\Models\LogLogbook;
use Illuminate\Http\Request;
use App\Models\CommentLaporan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DosbingController extends Controller
{
    public function dashboard(){
        $mbkm = Mbkm::where('dosen_pembimbing', auth()->user()->id)->latest()->get();
        // dd($mbkm);
        $user = '';

        if(empty($mbkm)){
            $user = User::where('email', $mbkm[0]->email)->get();
        }else{
            $user = $mbkm;
        }

        return view('dashboard.dosbing.dashboard', [
            'title' => 'Dashboard',
            'title_page' => 'Dashboard',
            'active' => 'Dashboard Dosbing',
            'name' => auth()->user()->name,
            'mahasiswa' => $user
            
        ]);
    }

    public function detailMahasiswa($id){
        
        return view('dashboard.dosbing.detail-mahasiswa', [
            'title' => 'Dashboard',
            'title_page' => 'Dashboard / Detail Mahasiswa',
            'active' => 'Dashboard Dosbing',
            'laporan' => Laporan::where('mbkm', $id)->with('listMbkm')->get()
        ]);
    }

    public function logbook(){
        $mbkm = Mbkm::where('dosen_pembimbing', auth()->user()->id)->get();
        $user = '';

        if(empty($mbkm)){
            $user = User::where('email', $mbkm[0]->email)->get();
        }else{
            $user = $mbkm;
        }
        return view('dashboard.dosbing.logbook', [
            'title' => 'Logbook',
            'title_page' => 'Logbook',
            'active' => 'Logbook Dosbing',
            'name' => auth()->user()->name,
            'mahasiswa' => $user
        ]);
    }
    
    public function listLogbookMahasiswa($id){
        return view('dashboard.dosbing.list-logbook', [
            'title' => 'Logbook',
            'title_page' => 'Logbook / Mahasiswa',
            'active' => 'Logbook Dosbing',
            'name' => auth()->user()->name,
            'logbooks' => Logbook::with('listMbkm')->where('mbkm', $id)->get()
        ]);
    }

    public function detailLogbook($id){
        $logbook = Logbook::with('listMbkm')->where('mbkm', $id)->get();
        // dd($logbook);
        $log_logbook = LogLogbook::where('logbook', $logbook[0]->id)->get();
        // dd($log_logbook);
        return view('dashboard.dosbing.detail-logbook',[
            'title' => 'Logbook',
            'title_page' => 'Logbook / Mahasiswa',
            'active' => 'Logbook Dosbing',
            'name' => auth()->user()->name,
            'owner' =>  $logbook[0]->name,
            'log_logbook' => $log_logbook,
        ]);
    }

    public function logLogbook($id){
        // $logbook = LogLogbook::find($id);
        $logbook = LogLogbook::with('listOwner')->where('id', $id)->get();
        // dd($logbook);
        return view('dashboard.dosbing.log-logbook',[
            'title' => 'Logbook',
            'title_page' => 'Logbook / Mahasiswa / Detail',
            'active' => 'Logbook Dosbing',
            'logbook' => $logbook
        ]);
    }

    public function logbookFinish($id){
        $log_logbook = LogLogbook::find($id);
        $log_logbook['status_dosbing'] = '1';
        $log_logbook->update();

        $logbook = Logbook::find($log_logbook->logbook);
        $mbkm = Mbkm::find($logbook->mbkm);
        // dd($mbkm->id);
        
        return redirect('/logbook/dosbing/detail/'.$mbkm->id)->with('success', 'Logbook Mahasiswa sudah dibaca');
    }

    public function laporan(){
        $mbkm = Mbkm::where('dosen_pembimbing', auth()->user()->id)->get();
        $user = '';
        if(empty($mbkm)){
            $user = User::where('email', $mbkm[0]->email)->get();
        }else{
            $user = $mbkm;
        }
        
        return view('dashboard.dosbing.laporan', [
            'title' => 'Laporan',
            'title_page' => 'Laporan',
            'active' => 'Laporan Dosbing',
            'name' => auth()->user()->name,
            'mahasiswa' => $user
        ]);
    }

    public function listLaporan($id){
        return view('dashboard.dosbing.list-laporan', [
            'title' => 'Laporan',
            'title_page' => 'Laporan',
            'active' => 'Laporan Dosbing',
            'laporans' => CommentLaporan::with('dataLaporan')->where('user', $id)->get()
        ]);
    }

    public function detailLaporan($id){

        return view('dashboard.dosbing.detail-laporan', [
            'title' => 'Laporan',
            'title_page' => 'Laporan / Detail',
            'active' => 'Laporan Dosbing',
            'laporan' => Laporan::where('id', $id)->with('listMbkm')->get(),
            'logcomment' => CommentLaporan::all()->where('laporan', $id)
        ]);
    }

    public function viewPdf($id){
        return view('dashboard.dosbing.view-pdf',[
            'laporan' => Laporan::where('id',$id)->get()
        ]);
    }

    public function approveFile(Request $request, $file){
        $laporan = Laporan::find($file);

        $laporan['status'] = 'Diterima';
        $laporan->update();
        return redirect('/laporan/dosbing')->with('success', 'Laporan Mahasiswa Berhasil Disetujui');

    }

    public function canceled(Request $request, $file){
        $laporan = Laporan::find($file);

        $laporan['status'] = 'Ditolak';
        $laporan->update();

        $commentLaporan = CommentLaporan::where('laporan', $laporan->id)->first();
        $commentLaporan->body = $request->body;
        $commentLaporan->update();

        return redirect('/laporan/dosbing')->with('success', 'Laporan Mahasiswa Berhasil Ditolak');

    }

    public function signPdf($id){
        return view('dashboard.dosbing.sign-pdf',[
            'laporan' => Laporan::where('id',$id)->get()
        ]);
    }

    public function savePdf(Request $request){
        $fileName = pathinfo($request->dokumenPath, PATHINFO_FILENAME);
        // dd($test);
        Storage::makeDirectory('dokumen-annotate');
        $data = json_decode($request->annotateJson, true);
        // $data = json_encode($request->annotateJson, true);
        Storage::put('dokumen-annotate/'. $fileName .'.json', json_encode($data));

        $rules['json_annotate'] = 'dokumen-annotate/'. $fileName .'.json';
        $rules['sign_second'] = '1';

        $pdf = Laporan::find($request->fileId);
        $pdf->update($rules);

        // return $pdf;
        return redirect('/laporan/dosbing')->with('success', 'Dokumen Laporan Berhasil ditandatangan!');       
    }

}
