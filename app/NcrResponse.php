<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;/*
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;*/

class NcrResponse extends Model
{
    use SoftDeletes;
    //use Auditable;

    protected $dates = ['deleted_at'];

    protected $fillable = [ 
        'user_id','ncr_id','problem_id','disp_unit_id','mrb_id',
        'problem_description','corrective_act','preventive_act',
        'corrective_est_date','preventive_est_date'
    ];    

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }


    public function unit_disposition()
    {
        return $this->belongsTo('App\UnitDisposition','disp_unit_id','id');
    }

    public function ncr_registration()
    {
        return $this->belongsTo('App\NcrRegistration','ncr_id','id');
    }

    public function mrb_disposition()
    {
        return $this->belongsTo('App\MrbDisposition','mrb_id','id');
    } 

    public function response_problem()
    {
        return $this->hasMany('App\ResponseProblem','resp_id','id');
    } 

}
