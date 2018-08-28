<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;/*
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;*/

class ResponseProblem extends Model
{
    use SoftDeletes;
    //use Auditable;

    protected $dates = ['deleted_at'];
            
    protected $fillable = [ 
        'resp_id','problem_id'
    ];

    public function ncr_response()
    {
        return $this->belongsTo('App\NcrResponse','resp_id','id');
    }

    public function problem_source()
    {
        return $this->belongsTo('App\ProblemSource','problem_id','id');
    }
}
