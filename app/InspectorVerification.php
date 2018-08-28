<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
// use OwenIt\Auditing\Auditable;
// use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class InspectorVerification extends Model 
{
    
    //use SoftDeletes;
    //use Auditable;
	
    //protected $dates = ['deleted_at'];
        
    protected $fillable = [ 
        'reg_id','resp_id','verification_description','verification_result_id','new_ncr_id', 'publish_date'
    ];

    public function ncr_reg(){
        return $this->belongsTo('App\NcrRegistration','reg_id','id');
    }

    public function ncr_resp(){
        return $this->belongsTo('App\NcrResponse','resp_id','id');
    }

    public function ver_result(){
        return $this->belongsTo('App\VerificationResult','verification_result_id','id');
    }

    public function new_ncr(){
        return $this->belongsTo('App\NcrRegistration','new_ncr_id','id');
    }
}
