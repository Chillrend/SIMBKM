<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\CommentLaporan;
use App\Models\LogSignaturePdf;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class LaporanController extends Controller
{
    public function index($id){
        
        return view('dashboard.detail-laporan', [
            'title' => 'Laporan',
            'title_page' => 'Laporan / Edit',
            'active' => 'Laporan',
            'name' => auth()->user()->name,
            'laporan' => Laporan::where('id', $id)->with('listMbkm')->get(),
            'logcomment' => CommentLaporan::all()->where('laporan', $id)
        ]);
    }    

    public function viewPdf($id){
        return view('dashboard.viewpdf',[
            'laporan' => Laporan::where('id',$id)->get(),
            'signature' => LogSignaturePdf::where('laporan_id', $id)->get()
        ]);
    }

    public function fetchDokumen(Request $request){
        $data['dokumen'] = Laporan::where("id", $request->dokumen)
                            ->get();
                            
        return response()->json($data);
    }

    public function update(Request $request, $id){

        $rules = $request->validate([
            'dokumen' => 'required|mimes:pdf'            
        ]);

        $rules['dokumen_name'] = $request->dokumen->getClientOriginalName();
        $rules['dokumen_path'] = $request->file('dokumen')->store('dokumen-laporan');
        // $rules['sign_first'] = 1;
        // $rules['sign_second']= 0;

        // Laporan::where('id', $id)->update($rules);

        $laporan = Laporan::find($id);

        $laporan->update($rules);

        LogSignaturePdf::create([
            'laporan_id' => $id
        ]);

        return redirect('/dashboard/laporan/'.$id)->with('success', 'Dokumen Laporan berhasil ditambahkan!');       
    }
    
    public function revisi(Request $request, $id){
        $rules = $request->validate([
            'dokumen' => 'required|mimes:pdf'            
        ]);

        $rules['dokumen_name'] = $request->dokumen->getClientOriginalName();
        $rules['dokumen_path'] = $request->file('dokumen')->store('dokumen-laporan');
        $rules['sign_first'] = 0;
        $rules['sign_second']= 0;
        $rules['status'] = 'sedang berjalan';

        // Laporan::where('id', $id)->update($rules);

        $laporan = Laporan::find($id);

        $laporan->update($rules);
        return redirect('/dashboard/laporan/'.$id)->with('success', 'Dokumen Laporan berhasil ditambahkan!');
    }

    public function savePdf(Request $request){
        $fileName = pathinfo($request->dokumenPath, PATHINFO_FILENAME);

        Storage::makeDirectory('dokumen-annotate');
        Storage::makeDirectory('dokumen-signature');
        Storage::makeDirectory('dokumen-signature-background');
        Storage::makeDirectory('dokumen-json-signature-background');

        $dataAnnotate = json_encode($request->annotateJson, true);
        $dataSignaturePertama = json_encode($request->signature_pertama, true);
        $dataJsonBackgroundSignature = json_encode($request->bgJson, true);
        
        Storage::put('dokumen-annotate/' . $fileName . '.json', json_decode($dataAnnotate));
        Storage::put('dokumen-signature/' . $fileName . '_pertama.json', json_decode($dataSignaturePertama));
        Storage::put('dokumen-json-signature-background/' . $fileName . '_pertama.json', json_decode($dataJsonBackgroundSignature));

        $rules['json_annotate'] = 'dokumen-annotate/'. $fileName .'.json';
        $rules['sign_first'] = '1';

        $rulesSignature['json_sign_pertama'] = 'dokumen-signature/' . $fileName . '_pertama.json';
        $rulesSignature['json_background_pertama'] = 'dokumen-json-signature-background/' . $fileName . '_pertama.json';
        $rulesSignature['file_background_pertama'] = $request->file('bgImage')->store('dokumen-signature-background');

        $pdf = Laporan::find($request->fileId);
        $pdf->update($rules);

        $signatureData = LogSignaturePdf::where('laporan_id', $request->fileId);
        $signatureData->update($rulesSignature);

        // return $pdf;
        return redirect('/dashboard/laporan')->with('success', 'Dokumen Laporan Berhasil ditandatangan!');       
    }

    public function previewPdf($id){
        return view('dashboard.preview-pdf',[
            'laporan' => Laporan::find($id)->get(),
            'signature' => LogSignaturePdf::where('laporan_id', $id)->get()
        ]);
    }

    public function saveAndRedirect(){
        return redirect('/dashboard/laporan')->with('success', 'Dokumen Laporan berhasil didownload!');       
    }

    
}
