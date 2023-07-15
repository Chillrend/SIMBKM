<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Fakultas;

class JurusanController extends Controller
{
    public function index(){
        return view('dashboard.jurusan',[
            'title' => 'Prodi',
            'title_page' => 'Prodi',
            'active' => 'Jurusan',
            'name' => auth()->user()->name,
            'jurusan' => Jurusan::all()
        ]);
    }

    public function create(){
        return view('dashboard.create-jurusan', [
            'title' => 'Create',
            'title_page' => 'Prodi / Create',
            'active' => 'Jurusan',
            'name' => auth()->user()->name,
            'fakultas' => Fakultas::all()
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:jurusan',
            'fakultas_id' => 'required',
            'status' => 'required'
        ]);
        Jurusan::create($validatedData);

        return redirect('/dashboard/jurusan')->with('success', 'Prodi Berhasil Dibuat!');
    }

    public function edit($id){
        return view('dashboard.edit-jurusan',[
            'title' => 'Edit',
            'title_page' => 'Prodi / Edit',
            'active' => 'Jurusan',
            'name' => auth()->user()->name,
            'jurusan' => Jurusan::find($id),
            'fakultas' => Fakultas::all()
        ]);
    }

    public function update(Request $request, $jurusan){

        $postingan = Jurusan::find($jurusan);

        $postingan->update($request->all());
        return redirect('/dashboard/jurusan')->with('success', 'Data Prodi has been updated!');

    }

    public function destroy($id){
        Jurusan::destroy($id);
        return redirect('/dashboard/jurusan')->with('success', 'Data Prodi Berhasil di Hapus');
    }
}
