<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKonversi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dataKurikulum(){
        return $this->belongsTo(Kurikulum::class, 'kurikulum');
    }

    // public function dataKurikulum(){
    //     return $this->hasMany(Kurikulum::class, 'dokumen');
    // }

    public function dataOwner(){
        return $this->belongsTo(User::class, 'owner');
    }
}
