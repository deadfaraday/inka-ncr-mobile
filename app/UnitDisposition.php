<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class UnitDisposition extends Model
{
    use SoftDeletes;
    use Auditable;
	
    protected $dates = ['deleted_at'];
    
    protected $fillable = [ 
        'description'
    ];

    public function ncr_response()
    {
        return $this->hasMany('App\NcrResponse');
    }
}
