<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helpers\ApiHelper;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Contracts\Auth\Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role');
    }

    public function additionalRoles()
    {
        return $this->belongsTo(Role::class, 'additional_role');
    }

    public function mbkms(){
        return $this->hasMany(Mbkm::class, 'user');
    }

    public function dataFakultas()
    {
        $client  = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));
        $jurusan = $client->get('/jurusan/find/' . $this->api_jurusan_id)->getBody()->getContents();
        $jurusan = json_decode($jurusan);
        return $jurusan;
    }

    public function dataJurusan()
    {
        $client = new ApiHelper(config('app.api_url'), config('app.api_user'), config('app.api_password'));
        $prodi  = $client->get('/prodi/find/' . $this->api_prodi_id)->getBody()->getContents();
        $prodi  = json_decode($prodi);
        return $prodi;
    }
}
