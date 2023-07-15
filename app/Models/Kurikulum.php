<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dataDokumen(){
        return $this->hasMany(HasilKonversi::class, 'kurikulum');
    }
}
