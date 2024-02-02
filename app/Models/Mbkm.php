<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mbkm extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where(function($query) use ($search){
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere(function($query) use ($search){
                    $query->whereHas('dataFakultas', function($fakultas) use ($search){
                        $fakultas->where('name', 'like', '%' . $search . '%');
                    });
                })
                ->orWhere(function($query) use ($search){
                    $query->whereHas('dataJurusan', function($jurusan) use ($search){
                        $jurusan->where('name', 'like', '%' . $search . '%');
                    });
                })
                ->orWhere(function($query) use ($search){
                    $query->whereHas('dataProgram', function($program) use ($search){
                        $program->where('name', 'like', '%' . $search . '%');
                    });
                });
            });
        });
    }


    public function tahun_ajaran(){
        $this->belongsTo(TahunAjaranMbkm::class, 'tahun_ajaran');
    }



    public function dataProgram(){
        return $this->belongsTo(ProgramMbkm::class, 'program');
    }

    public function mbkms(){
        return $this->hasMany(Logbook::class);
    }

    public function namaUser(){
        return $this->belongsTo(User::class, 'user');
    }

    public function listUser(){
        return $this->belongsTo(User::class, 'dosen_pembimbing');
    }

    public function listPI(){
        return $this->belongsTo(User::class, 'pembimbing_industri');
    }
}
