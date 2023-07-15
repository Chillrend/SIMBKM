<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    public $table = "jurusan";

    protected $guarded = ['id'];

    public function listFakultas(){
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }
}
