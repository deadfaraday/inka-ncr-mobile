<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class UnitInspectorCode extends Model
{
    use SoftDeletes;

    protected $fillable = [ 
        'division_id','ui_code','ui_description','is_inspector'
    ];

    public function ncr_response()
    {
        return $this->hasMany('App\NcrResponse');
    }

}
