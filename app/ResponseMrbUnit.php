<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseMrbUnit extends Model
{
    
    protected $dates = ['deleted_at'];
            
    protected $fillable = [ 
        'response_id','mrb_disp_id','division_id'
    ];

    public function response(){
        return $this->belongsTo('App\NcrResponse','response_id','id');
    }

    public function mrb_disp(){
        return $this->belongsTo('App\MrbDisposition','mrb_disp_id','id');
    }

    public function division(){
        return $this->belongsTo('App\Division','division_id','id');
    }
        
}
