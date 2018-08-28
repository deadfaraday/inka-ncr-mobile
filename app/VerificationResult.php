<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;/*
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;*/

class VerificationResult extends Model
{
    //use SoftDeletes;
    //use Auditable;

    //protected $dates = ['deleted_at'];
            
    protected $fillable = [ 
        'description'
    ];
}
