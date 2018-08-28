<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;/*
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;*/

class ProblemSource extends Model
{
    use SoftDeletes;
    //use Auditable;

    protected $dates = ['deleted_at'];
    
        /*
                $table->string('no_reg_ncr')->unique();
                $table->integer('user_id')->unsigned();
        */

    protected $fillable = [ 
        'description'
    ];

    
    public function ncr_responses()
    {
        return $this->hasManyThrough(
            'App\NcrResponse',
            'App\NcrResponseProblem',
            'problem_id', // Foreign key on users table...
            'response_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }
}
