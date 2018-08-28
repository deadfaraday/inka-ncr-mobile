<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;/*
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;*/

class NcrResponseProblem extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = [ 
        'response_id','problem_id'
    ];

    public function ncr_response(){
        return $this->belongsTo('App\NcrResponse','response_id','id');
    }

    public function problem_source(){
        return $this->belongsTo('App\ProblemSource','problem_id','id');
    }

}
