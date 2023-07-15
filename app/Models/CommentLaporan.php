<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLaporan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dataLaporan(){
        return $this->belongsTo(Laporan::class, 'laporan');
    }

    
}
