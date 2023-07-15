<?php

namespace App\Http\Controllers;

use App\Models\CommentKonversi;
use App\Models\Kurikulum;
use App\Models\LogMatakuliah;
use App\Models\HasilKonversi;
use App\Models\LogCommentKonversi;
use Illuminate\Http\Request;

class HasilKonversiController extends Controller
{
    public function index($id){

        // $konversi = HasilKonversi::all()->where('kurikulum', $id);
        
        // $commentKonversi = CommentKonversi::all()->where('hasil_konversi', $konversi[0]['id']);

        return view('dashboard.detail-hasil-konversi', [
            'title' => 'Detail',
            'title_page' => 'Hasil Konversi / Detail',
            'name' => auth()->user()->name,
            'active' => 'Hasil Konversi',
            'kurikulum' => Kurikulum::find($id),
            'matakuliah' => LogMatakuliah::all()->where('kurikulum', $id),
            'logcomment' => CommentKonversi::with('dataHasilKonversi')->where('owner', auth()->user()->id)->latest()->get()
        ]);
    }
}
