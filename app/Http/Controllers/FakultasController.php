<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index(){
        return view('dashboard.fakultas',[
            'title' => 'Jurusan',
            'title_page' => 'Jurusan',
            'active' => 'Fakultas',
            'name' => auth()->user()->name,
            'fakultas' => Fakultas::all()
        ]);
    }

    public function create(){
        return view('dashboard.create-fakultas', [
            'title' => 'Create',
            'title_page' => 'Jurusan / Create',
            'active' => 'Fakultas',
            'name' => auth()->user()->name,
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:fakultas',
            'status' => 'required'
        ]);
        Fakultas::create($validatedData);

        return redirect('/dashboard/fakultas')->with('success', 'Fakultas Berhasil Dibuat!');
    }

    public function edit($id){

        return view('dashboard.edit-fakultas',[
            'title' => 'Edit',
            'title_page' => 'Jurusan / Edit',
            'active' => 'Fakultas',
            'name' => auth()->user()->name,
            'fakultas' => Fakultas::find($id)
        ]);
    }

    public function update(Request $request, $role){

        $postingan = Fakultas::find($role);

        $postingan->update($request->all());
        return redirect('/dashboard/fakultas')->with('success', 'Data Jurusan has been updated!');

    }

    public function destroy($id){
        Fakultas::destroy($id);
        $jurusan = Jurusan::where('fakultas_id', $id)->get();
        Jurusan::destroy($jurusan);
        return redirect('/dashboard/fakultas')->with('success', 'Data Jurusan Berhasil di Hapus');
    }
}
