<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function listMbkm(){
        return $this->belongsTo(Mbkm::class, 'mbkm');
    }

    public function pemilik(){
        return $this->belongsTo(User::class, 'owner');
    }
}
