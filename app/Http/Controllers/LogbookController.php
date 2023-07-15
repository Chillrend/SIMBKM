<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\LogLogbook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
class LogbookController extends Controller
{

    public function index(){
        return view('dashboard.logbook', [
            'title' => 'Logbook',
            'title_page' => 'Logbook',
            'active' => 'Logbook',
            'name' => auth()->user()->name,
            'logbooks' => Logbook::with('listMbkm')->where('user', auth()->user()->id)->get()
        ]);
    }

    public function create($id){        
        $owner = Logbook::find($id);
        if($owner['user'] != auth()->user()->id){
            abort(403);
        }

        return view('dashboard.create-logbook',[
            'title' => 'Create',
            'title_page' => 'Logbook / Create',
            'name' => auth()->user()->name,
            'active' => 'Logbook',
            'idLogbook' => $id
        ]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'tanggal_dibuat' => 'required',
            'body' => 'required',
            // 'lokasi' => 'required',
            'logbook' => 'required'
        ]);
        $validatedData['owner'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($validatedData['body'], 100));

        LogLogbook::create($validatedData);

        return redirect('/dashboard/logbook')->with('success', 'Logbook Berhasil Dibuat!');
    }

    public function myLogbook($id){
        $owner = Logbook::find($id);
        if($owner['user'] != auth()->user()->id){
            abort(403);
        }
        return view('dashboard.my-logbook',[
            'title' => 'List',
            'title_page' => 'Logbook / List',
            'name' => auth()->user()->name,
            'active' => 'Logbook',
            'idLogbook' => $id,
            'log_logbooks' => LogLogbook::where('logbook', $id)->get()
        ]);
    }

    public function detail($id){
        $pemilik = LogLogbook::find($id);
        if($pemilik['owner'] != auth()->user()->id){
            abort(403);
        }
        return view('dashboard.detail-logbook',[
            'title' => 'Detail',
            'title_page' => 'Logbook / List / Detail',
            'name' => auth()->user()->name,
            'active' => 'Logbook',
            'log_logbooks' => LogLogbook::find($id)
        ]);
    }

    public function edit($id){
        $pemilik = LogLogbook::find($id);
        if($pemilik['owner'] != auth()->user()->id){
            abort(403);
        }
        return view('dashboard.edit-log-logbook',[
            'title' => 'Edit',
            'title_page' => 'Logbook / List / Detail / Edit',
            'name' => auth()->user()->name,
            'active' => 'Logbook',
            'log_logbooks' => LogLogbook::find($id)
        ]);
    }

    public function update(Request $request, $id){
        $dataLogbook = LogLogbook::find($id);
        
        if($dataLogbook['owner'] != auth()->user()->id){
            abort(403);
        }
        $dataLogbook['excerpt'] = Str::limit(strip_tags($dataLogbook['body'], 100));

        $dataLogbook->update($request->all());
        return redirect('/dashboard/logbook')->with('success', 'Data Logbook has been updated!');
    }

    public function destroy($id){
        $pemilik = LogLogbook::find($id);
        if($pemilik['owner'] != auth()->user()->id){
            abort(403);
        }
        LogLogbook::destroy($id);
        return redirect('/dashboard/logbook')->with('success', 'Data Logbook Berhasil di Hapus');
    }
}
