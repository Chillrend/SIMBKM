<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramMbkm extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $fillable = ['id', 'name', 'status'];

    public function mbkms(){
        return $this->hasMany(Mbkm::class, 'program');
    }
}
