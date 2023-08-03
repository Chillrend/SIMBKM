<?php

namespace App\Http\Controllers;

use App\Models\Mbkm;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Logbook;
use App\Models\LogLogbook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CommentLaporan;
use App\Models\LogSignaturePdf;
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
        $laporan = Laporan::where('mbkm', $id)->get();
        return view('dashboard.pembimbing-industri.list-laporan', [
            'title' => 'List Laporan',
            'title_page' => 'Laporan / List Laporan',
            'active' => 'Laporan Pembimbing Industri',
            'laporans' => CommentLaporan::with('dataLaporan')->where('laporan', $laporan[0]->id)->get()
        ]);
    }

    public function detailLaporan($id){
        $test = Laporan::find($id)->with('listMbkm')->get();
        return view('dashboard.pembimbing-industri.detail-laporan', [
            'title' => 'Laporan',
            'title_page' => 'Laporan / Detail',
            'active' => 'Laporan Pembimbing Industri',
            'laporan' => Laporan::where('id',$id)->with('listMbkm')->get(),
            'logcomment' => CommentLaporan::all()->where('laporan', $id)
        ]);
    }

    public function signPdf($id){
        return view('dashboard.pembimbing-industri.sign-pdf',[
            'laporan' => Laporan::find($id)->get(),
            'signature' => LogSignaturePdf::where('laporan_id', $id)->get()
        ]);
    }

    public function savePdf(Request $request){
        $fileName = pathinfo($request->dokumenPath, PATHINFO_FILENAME);
        $newFileName = Str::random(10);

        // dd($request);
        Storage::makeDirectory('dokumen-annotate');
        Storage::makeDirectory('dokumen-signature');
        Storage::makeDirectory('dokumen-signature-background');
        Storage::makeDirectory('dokumen-json-signature-background');

        $dataAnnotate = json_encode($request->annotateJson, true);
        $dataSignaturePertama = json_encode($request->signature_ketiga, true);
        $dataJsonBackgroundSignature = json_encode($request->bgJson, true);
        
        Storage::put('dokumen-annotate/' . $fileName . '.json', json_decode($dataAnnotate));
        Storage::put('dokumen-signature/' . $newFileName . '_ketiga.json', json_decode($dataSignaturePertama));
        Storage::put('dokumen-json-signature-background/' . $newFileName . '_ketiga.json', json_decode($dataJsonBackgroundSignature));

        $rules['json_annotate'] = 'dokumen-annotate/'. $fileName .'.json';
        $rules['sign_third'] = '1';

        $rulesSignature['json_sign_ketiga'] = 'dokumen-signature/' . $newFileName . '_ketiga.json';
        $rulesSignature['json_background_ketiga'] = 'dokumen-json-signature-background/' . $newFileName . '_ketiga.json';
        $rulesSignature['file_background_ketiga'] = $request->file('bgImage')->store('dokumen-signature-background');

        $pdf = Laporan::find($request->fileId);
        $pdf->update($rules);

        $signatureData = LogSignaturePdf::where('laporan_id', $request->fileId);
        $signatureData->update($rulesSignature);

        // return $pdf;
        return redirect('/laporan/pi')->with('success', 'Dokumen Laporan Berhasil ditandatangan!');       
    }
}
