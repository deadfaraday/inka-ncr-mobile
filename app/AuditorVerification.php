<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class AuditorVerification extends Model
{
    //use SoftDeletes;
    //use Auditable;
	
    //protected $dates = ['deleted_at'];

    /*
         $table->integer('reg_ncr_id')->unsigned();
            $table->integer('resp_ncr_id')->unsigned();
            $table->longtext('verification_description');
            $table->integer('ver_result_id')->unsigned();
            $table->integer('new_car_id')->unsigned()->nullable();

    */
        
    protected $fillable = [ 
        'reg_ncr_id','resp_ncr_id','verification_description',
        'publish_date','ver_result_id','new_car_id','auditor_id'
    ];

    public function ncr_reg(){
        return $this->belongsTo('App\NcrRegistration','reg_ncr_id','id');
    }

    public function ncr_resp(){
        return $this->belongsTo('App\NcrResponse','resp_ncr_id','id');
    }

    public function ver_result(){
        return $this->belongsTo('App\VerificationResult','ver_result_id','id');
    }

    public function auditor(){
        return $this->belongsTo('App\User','auditor_id','id');
    }

    /*
    public function new_ncr(){
        return $this->belongsTo('App\NcrRegistration','new_ncr_id','id');
    }
    */
}
