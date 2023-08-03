<?php

namespace App\Http\Controllers;

use App\Models\Mbkm;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Logbook;
use App\Models\LogLogbook;
use App\Models\LogSignaturePdf;
use Illuminate\Http\Request;
use App\Models\CommentLaporan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DosbingController extends Controller
{
    public function dashboard(){
        $mbkm = Mbkm::where('dosen_pembimbing', auth()->user()->id)->get();
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
        $laporan = Laporan::where('mbkm', $id)->get();
        return view('dashboard.dosbing.list-laporan', [
            'title' => 'Laporan',
            'title_page' => 'Laporan',
            'active' => 'Laporan Dosbing',
            'laporans' => CommentLaporan::with('dataLaporan')->where('laporan', $laporan[0]->id)->get()
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
            'laporan' => Laporan::where('id',$id)->get(),
            'signature' => LogSignaturePdf::where('laporan_id', $id)->get()
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
            'laporan' => Laporan::where('id',$id)->get(),
            'signature' => LogSignaturePdf::where('laporan_id', $id)->get()
        ]);
    }

    public function savePdf(Request $request){
        $fileName = pathinfo($request->dokumenPath, PATHINFO_FILENAME);
        $newFileName = Str::random(10);

        // dd($newFileName);
        Storage::makeDirectory('dokumen-annotate');
        Storage::makeDirectory('dokumen-signature');
        Storage::makeDirectory('dokumen-signature-background');
        Storage::makeDirectory('dokumen-json-signature-background');

        $dataAnnotate = json_encode($request->annotateJson, true);
        $dataSignaturePertama = json_encode($request->signature_kedua, true);
        $dataJsonBackgroundSignature = json_encode($request->bgJson, true);
        
        Storage::put('dokumen-annotate/' . $fileName . '.json', json_decode($dataAnnotate));
        Storage::put('dokumen-signature/' . $newFileName . '_kedua.json', json_decode($dataSignaturePertama));
        Storage::put('dokumen-json-signature-background/' . $newFileName . '_kedua.json', json_decode($dataJsonBackgroundSignature));

        $rules['json_annotate'] = 'dokumen-annotate/'. $fileName .'.json';
        $rules['sign_second'] = '1';

        $rulesSignature['json_sign_kedua'] = 'dokumen-signature/' . $newFileName . '_kedua.json';
        $rulesSignature['json_background_kedua'] = 'dokumen-json-signature-background/' . $newFileName . '_kedua.json';
        $rulesSignature['file_background_kedua'] = $request->file('bgImage')->store('dokumen-signature-background');

        $pdf = Laporan::find($request->fileId);
        $pdf->update($rules);

        $signatureData = LogSignaturePdf::where('laporan_id', $request->fileId);
        $signatureData->update($rulesSignature);

        // return $pdf;
        return redirect('/laporan/dosbing')->with('success', 'Dokumen Laporan Berhasil ditandatangan!');       
    }

}
