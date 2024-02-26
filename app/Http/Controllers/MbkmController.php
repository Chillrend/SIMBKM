<?php

namespace App\Http\Controllers;

use DateTime;
use App\Helpers\ApiHelper;
use App\Models\CommentLaporan;
use App\Models\Mbkm;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Logbook;
use App\Models\Fakultas;
use App\Models\Laporan;
use App\Models\ProgramMbkm;
use App\Models\TahunAjaranMbkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class MbkmController extends Controller
{

    public function programIndex()
    {
        return view('dashboard.program-mbkm', [
            'title'       => 'Program MBKM',
            'title_page'  => 'Program MBKM',
            'active'      => 'Program Mbkm',
            'name'        => auth()->user()->name,
            'programMbkm' => ProgramMbkm::all()
        ]);
    }

    public function storeProgram(Request $request)
    {

        $validatedData = $request->validate([
            'name'      => 'required|unique:program_mbkms',
            'status'    => 'required',
            'deskripsi' => 'required',
            'fotoikon'  => 'required|image'
        ]);
        if ($request->hasFile('fotoikon')) {
            if ($request->file('fotoikon')->isValid()) {
                $validatedData['fotoikon'] = $request->fotoikon->storeAs('img', 'public');
            } else {
                return redirect('/dashboard/program-mbkm')->with('error', 'Upload file gagal!');
            }
        } else {
            return redirect('/dashboard/program-mbkm')->with('error', 'File tidak ditemukan!');
        }

        ProgramMbkm::create($validatedData);

        return redirect('/dashboard/program-mbkm')->with('success', 'Program MBKM Berhasil Dibuat!');
    }

    public function create()
    {
        return view('dashboard.create-program-mbkm', [
            'title'      => 'Create',
            'title_page' => 'Program MBKM / Create',
            'active'     => 'Program Mbkm',
            'name'       => auth()->user()->name,
        ]);
    }

    public function edit($id)
    {
        return view('dashboard.edit-program-mbkm', [
            'title'      => 'Edit',
            'title_page' => 'Program Mbkm / Edit',
            'active'     => 'Program Mbkm',
            'name'       => auth()->user()->name,
            'program'    => ProgramMbkm::find($id),
        ]);
    }

    public function destroy($id)
    {
        $mbkm = ProgramMbkm::find($id);
        if ($mbkm) {
            $mbkm->delete();
            return redirect('/dashboard/program-mbkm')->with('success', 'Program Mbkm has been deleted!');
        } else {
            return redirect('/dashboard/program-mbkm')->with('error', 'Program Mbkm not found!');
        }
    }

    public function myForm()
    {
        $client = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));

        $response = $client->get("/mahasiswa/search/" . auth()->user()->nim)->getBody()->getContents();
        $id_prodi = json_decode($response, true)['0']['id_program_studi'];

        $response   = $client->get("/prodi/find/$id_prodi")->getBody()->getContents();
        $nama_prodi = json_decode($response, true)['nama_prodi'];

        $response   = $client->get("/prodi/find/$id_prodi")->getBody()->getContents();
        $id_jurusan = json_decode($response, true)['id_jurusan'];

        $response     = $client->get("/jurusan/find/$id_jurusan")->getBody()->getContents();
        $nama_jurusan = json_decode($response, true)['nama_jurusan'];

        return view('dashboard.my-mbkm-form', [
            'title'      => 'My Mbkm Form',
            'title_page' => 'Informasi Mbkm / Form Mbkm Saya',
            'active'     => 'Informasi MBKM',
            'name'       => auth()->user()->name,
            'studi'      => (object)[
                'jurusan' => $nama_jurusan,
                'prodi'   => $nama_prodi
            ],
            'mbkms'      => Mbkm::where('user', auth()->user()->id)->with('listPI')->with('listUser')->get()
        ]);
    }

    public function editMyForm(Mbkm $mbkm)
    {

        //     if($author != auth()->user()->id) {
        //         abort(403);
        //    }

        return view('dashboard.edit-my-mbkm-form', [
            'title'               => 'Edit',
            'title_page'          => 'Informasi Mbkm / Form Mbkm Saya / Edit',
            'active'              => 'Informasi MBKM',
            'name'                => auth()->user()->name,
            'mbkm'                => $mbkm,
            'programs'            => ProgramMbkm::where('status', 'Aktif')->get(),
            'tahun_ajaran'        => TahunAjaranMbkm::all()->sortByDesc('id'),
            'dosbing'             => User::where(function ($query) {
                $query->where('role', '4')->orWhere('additional_role', '4');
            })->where('api_prodi_id', $mbkm->namaUser->api_prodi_id)->get(),
            'pembimbing_industri' => User::where('role', '6')->orWhere('additional_role', '6')->get(),
        ]);
    }

    public function updateMyForm(Request $request, $mbkm)
    {

        //     if($mbkm != auth()->user()->id) {
        //         abort(403);
        //    }

        $form = Mbkm::find($mbkm);

        $rules = [
            'program'                   => 'required',
            'tanggal_mulai'             => 'required',
            'mobilisasi'                => 'nullable',
            'lokasi_program'            => 'nullable',
            'lokasi_mobilisasi'         => 'nullable',
            'pembimbing_industri'       => 'nullable',
            'dosen_pembimbing'          => 'nullable',
            'informasi_tambahan'        => 'nullable',
            'tanggal_selesai'           => 'required',
            'tahun_ajaran'              => 'required',
            'tempat_program_perusahaan' => 'required',
            'program_keberapa'          => 'required',
        ];

        $form->update($request->validate($rules));
        return redirect('/dashboard/informasi-mbkm/personal')->with('success', 'Data Mbkm has been updated!');
    }

    public function update(Request $request, $id)
    {
        $mbkm = ProgramMbkm::find($id);

        if ($mbkm) {
            $validatedData = $request->validate([
                'name'      => 'required|unique:program_mbkms,name,' . $mbkm->id,
                'status'    => 'required',
                'deskripsi' => 'required',
                'fotoikon'  => 'image'
            ]);

            if ($request->hasFile('fotoikon')) {
                if ($request->file('fotoikon')->isValid()) {
                    // Delete the old file
                    if ($mbkm->fotoikon && Storage::disk('public')->exists('img/' . $mbkm->fotoikon)) {
                        $deleteStatus = Storage::disk('public')->delete('img/' . $mbkm->fotoikon);

                        if (!$deleteStatus) {
                            // Log an error message if the file couldn't be deleted
                            Log::error("Could not delete image: public/img/" . $mbkm->fotoikon);
                        }
                    }

                    // Store the new file
                    $filename                  = $request->fotoikon->store('img', 'public');
                    $validatedData['fotoikon'] = $filename;
                } else {
                    // If no new image is uploaded, keep the old image
                    $validatedData['fotoikon'] = $mbkm->fotoikon;
                }
            }

            $mbkm->update($validatedData);

            return redirect('/dashboard/program-mbkm')->with('success', 'Data Program Mbkm has been updated!');
        } else {
            return redirect('/dashboard/program-mbkm')->with('error', 'Program Mbkm not found!');
        }
    }

    public function store(Request $request)
    {
        $client = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));
        $nim    = auth()->user()->nim;

        $response = $client->get("/mahasiswa/search/$nim");
        $namamhsw = json_decode($response->getBody()->getContents(), true)['0']['nama_mhs'];

        $response     = $client->get("/mahasiswa/search/$nim");
        $semestermhsw = substr(strval(json_decode($response->getBody()->getContents(), true)['0']['id_tahun_akademik']), 0, 4);

        $startDate = DateTime::createFromFormat('Y-m', $semestermhsw . '-09');
        $now       = new DateTime();

        $interval = $startDate->diff($now);

        $totalMonths  = $interval->y * 12 + $interval->m;
        $semestercurr = ceil($totalMonths / 6);

        $response    = $client->get("/mahasiswa/search/$nim");
        $idprodimhsw = json_decode($response->getBody()->getContents(), true)['0']['id_program_studi'];

        $prodiresponse = $client->get("/prodi/find/$idprodimhsw");
        $idjurusan     = json_decode($prodiresponse->getBody()->getContents(), true)['id_jurusan'];

        $validatedData = $request->validate([
            'program'                   => 'required',
            'tanggal_mulai'             => 'required',
            'mobilisasi'                => 'nullable',
            'lokasi_program'            => 'nullable',
            'lokasi_mobilisasi'         => 'nullable',
            'pembimbing_industri'       => 'nullable',
            'dosen_pembimbing'          => 'nullable',
            'informasi_tambahan'        => 'nullable',
            'tanggal_selesai'           => 'required',
            'tahun_ajaran'              => 'required',
            'tempat_program_perusahaan' => 'required',
            'program_keberapa'          => 'required',
        ]);

        $validatedData['user']           = auth()->user()->id;
        $validatedData['name']           = auth()->user()->name = $namamhsw;
        $validatedData['api_prodi_id']   = auth()->user()->api_prodi_id = $idprodimhsw;
        $validatedData['api_jurusan_id'] = auth()->user()->api_jurusan_id = $idjurusan;
        $validatedData['semester']       = auth()->user()->semester = $semestercurr;


        Mbkm::create($validatedData);

        $lastIdMbkm = DB::table('mbkms')
            ->select('id')
            ->where('user', '=', auth()->user()->id)
            ->orderByDesc('id')
            ->limit(1)
            ->get();

        Logbook::create([
            'name' => auth()->user()->name,
            'mbkm' => $lastIdMbkm[0]->id,
            'user' => auth()->user()->id
        ]);

        Laporan::create([
            'mbkm'  => $lastIdMbkm[0]->id,
            'owner' => auth()->user()->id
        ]);

        $lastIdLaporan = DB::table('laporans')
            ->select('id')
            ->where('owner', '=', auth()->user()->id)
            ->orderByDesc('id')
            ->limit(1)
            ->get();

        CommentLaporan::create([
            'body'    => 'Belum ada komen',
            'laporan' => $lastIdLaporan[0]->id,
            'user'    => auth()->user()->id
        ]);

        return redirect('/dashboard/informasi-mbkm')->with('success', 'New Data Mbkm has been added!');
    }

    public function getAllMBKM()
    {
        return view('dashboard.list-mbkm-mhsw', [
            'title'       => 'Daftar MBKM Mahasiswa',
            'title_page'  => 'MBKM Mahasiswa',
            'active'      => 'Mbkm Mahasiswa',
            'name'        => auth()->user()->name,
            'programMbkm' => Mbkm::all()
        ]);
    }


    public function getMBKM($mbkm)
    {
        return view('dashboard.get-mbkm-mhsw', [
            'title'               => 'Lihat',
            'title_page'          => 'Informasi Mbkm Mahasiswa',
            'active'              => 'Informasi MBKM',
            'name'                => auth()->user()->name,
            'mbkm'                => Mbkm::find($mbkm),
            'programs'            => ProgramMbkm::where('status', 'Aktif')->get(),
            'tahun_ajaran'        => TahunAjaranMbkm::all()->sortByDesc('id'),
            'dosbing'             => User::where('role', '4')->orWhere('additional_role', '4')->get(),
            'pembimbing_industri' => User::where('role', '6')->orWhere('additional_role', '6')->get(),
        ]);
    }
}
