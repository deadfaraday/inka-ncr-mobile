<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Division extends Model implements AuditableContract
{
	use SoftDeletes;
    use Auditable;
	
    protected $dates = ['deleted_at'];

    protected $fillable = [ 
        'division_name','parent','kadiv_nip'
    ];

    public function division()
    {
        return $this->hasMany('App\NcrRegistration');
    }
}
