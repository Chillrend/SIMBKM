<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\CommentLaporan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class LaporanController extends Controller
{
    public function index($id){

        $test = Laporan::find($id)->with('listMbkm')->get();
        // dd($test);
        return view('dashboard.detail-laporan', [
            'title' => 'Laporan',
            'title_page' => 'Laporan / Edit',
            'active' => 'Laporan',
            'name' => auth()->user()->name,
            'laporan' => Laporan::find($id)->with('listMbkm')->get(),
            'logcomment' => CommentLaporan::all()->where('laporan', $id)
        ]);
    }    

    public function viewPdf($id){
        return view('dashboard.viewpdf',[
            'laporan' => Laporan::find($id)->get()
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
        $rules['sign_first'] = 0;
        $rules['sign_second']= 0;

        // Laporan::where('id', $id)->update($rules);

        $laporan = Laporan::find($id);

        $laporan->update($rules);

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
        Storage::makeDirectory('dokumen-annotate');
        $data = json_decode($request->file, true);
        Storage::put('dokumen-annotate/'.$request->name.'.json', json_encode($data));

        $rules['json_annotate'] = 'dokumen-annotate/'.$request->name.'.json';
        $rules['sign_first'] = '1';

        $pdf = Laporan::find($request->fileId);
        $pdf->update($rules);

        return $pdf;
    }

    public function previewPdf($id){
        return view('dashboard.preview-pdf',[
            'laporan' => Laporan::find($id)->get()
        ]);
    }

    public function saveAndRedirect(){
        return redirect('/dashboard/laporan')->with('success', 'Dokumen Laporan berhasil didownload!');       
    }

    
}
