<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/*
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;
*/

class MasterProject extends Model
{
	use SoftDeletes;
    //use Auditable;

    /*
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }
    */

    protected $dates = ['deleted_at'];
    
    protected $fillable = [ 
        'project_code','project_description','is_close'
    ];

    public function product()
    {
        return $this->hasMany('App\NcrRegistration');
    }

}
