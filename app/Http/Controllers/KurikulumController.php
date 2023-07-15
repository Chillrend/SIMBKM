<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use App\Models\LogMatakuliah;
use App\Models\HasilKonversi;
use App\Models\CommentKonversi;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class KurikulumController extends Controller
{

    public function store(Request $request){

        $kurikulum = $request->validate([
            'dokumen' => 'required|mimes:pdf,xlx,csv|max:2048'            
        ]);

        $kurikulum['owner'] = auth()->user()->id;
        $kurikulum['dokumen_name'] = $request->dokumen->getClientOriginalName();
        $kurikulum['dokumen_path'] = $request->file('dokumen')->store('dokumen-kurikulum');

        Kurikulum::create($kurikulum);

        $lastIdKurikulum = DB::table('kurikulums')
                            ->select('id')
                            ->where('owner', '=', auth()->user()->id)
                            ->orderByDesc('id')
                            ->limit(1)
                            ->get();
        
        
        // dd($lastIdKurikulum[0]->id);


        $request->validate([
            'inputs.*.mata_kuliah' => 'required',
            'inputs.*.sks' => 'required'
        ],[
            'inputs.*.mata_kuliah' => 'Mata Kuliah Tidak Boleh Kosong',
            'inputs.*.sks' => 'SKS tidak boleh kosong',
        ]);
        
        foreach($request->inputs as $key => $value){
            LogMatakuliah::create([
                'mata_kuliah' => $value['mata_kuliah'],
                'sks' => $value['sks'],
                'kurikulum' => $lastIdKurikulum[0]->id
            ]);
        }

        HasilKonversi::create([
            'kurikulum' => $lastIdKurikulum[0]->id,
            'owner' => auth()->user()->id
        ]);

        $lastIdKonversis = DB::table('hasil_konversis')
                            ->select('id')
                            ->where('owner', '=', auth()->user()->id)
                            ->orderByDesc('id')
                            ->get();

        CommentKonversi::create([
            'hasil_konversi' => $lastIdKonversis[0]->id,
            'body' => 'Belum ada komen',
            'owner' => auth()->user()->id
        ]);

        return redirect('/dashboard/upload-kurikulum')->with('success', 'Upload Kurikulum has been Added!');
    }

}
