<?php

namespace App\Models;

use App\Helpers\ApiHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\search;

class Mbkm extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $client = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));

        $response = $client->get("/jurusan/all")->getBody()->getContents();
        $fakultas = collect(json_decode($response, true));
        $fakultas = $fakultas->map(function ($fakulta) use ($client) {
            return (object)([
                'id'           => $fakulta['id'],
                'nama_jurusan' => $fakulta['nama_jurusan'],
            ]);
        });

        $response = $client->get("/prodi/all")->getBody()->getContents();
        $jurusans = collect(json_decode($response, true));
        $jurusans = $jurusans->map(function ($jurusan) use ($client) {
            return (object)([
                'id'         => $jurusan['id'],
                'nama_prodi' => $jurusan['nama_prodi'],
                'id_jurusan' => $jurusan['id_jurusan'],
            ]);
        });

        $query->when($filters['search'] ?? false, function ($query, $search) use ($fakultas, $jurusans) {
            return $query->where(function ($query) use ($search, $fakultas, $jurusans) {
                //Mencari di mbkms
                $query->orWhere(function ($query) use ($search) {
                    $query->whereHas('namaUser', function ($userquery) use ($search) {
                        $userquery->where('users.name', 'like', '%' . $search . '%');
                    });
                })

                //Mencari Berdasarkan Fakultasi User
                ->orWhere(function ($fakultasquery) use ($search, $fakultas) {
                    $fakultasquery->whereHas('namaUser', function ($fakultasquery) use ($search, $fakultas) {
                        $fakultas = $fakultas->filter(function ($value, $key) use ($search) {
                            return strpos($value->nama_jurusan, $search) !== false;
                        })->values()->pluck('id');
                        $fakultasquery->whereIn('api_jurusan_id', $fakultas);
                    });
                })

                //Mencari Berdasarkan Jurusan User
                ->orWhere(function ($jurusanquery) use ($search, $jurusans) {
                    $jurusanquery->whereHas('namaUser', function ($jurusanquery) use ($search, $jurusans) {
                        $jurusans = $jurusans->filter(function ($value, $key) use ($search) {
                            return strpos($value->nama_prodi, $search) !== false;
                        })->values()->pluck('id');
                        $jurusanquery->whereIn('api_prodi_id', $jurusans);
                    });
                });
            });
        });
    }


    public function thn_ajaran()
    {
        return $this->belongsTo(TahunAjaranMbkm::class, 'tahun_ajaran');
    }


    public function dataProgram()
    {
        return $this->belongsTo(ProgramMbkm::class, 'program');
    }

    public function mbkms()
    {
        return $this->hasMany(Logbook::class);
    }

    public function namaUser()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function listUser()
    {
        return $this->belongsTo(User::class, 'dosen_pembimbing');
    }

    public function listPI()
    {
        return $this->belongsTo(User::class, 'pembimbing_industri');
    }
}
