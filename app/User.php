<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nip', 'email', 'password', 'photo', 'jabatan_id', 'divisi_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected $appends = [];

    public function user_inspector()
    {
        return $this->belongsTo('App\UserInspektor');
    }

    public function division()
    {
        return $this->belongsTo('App\Division','divisi_id','id');
    }

    public function getPhotoAttribute($photo)
    {
        if (Storage::exists($photo)) {
            return base64_encode(Storage::get($photo));            
        }
        return $photo;
    }
}
