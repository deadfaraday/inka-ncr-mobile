<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/*
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;
*/

class NcrUnit extends Model
{
    use SoftDeletes;

    protected $fillable = [ 
        'unit_code','description'
    ];

}
