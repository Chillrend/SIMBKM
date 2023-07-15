<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentKonversi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dataHasilKonversi(){
        return $this->belongsTo(HasilKonversi::class, 'hasil_konversi');
    }
}
