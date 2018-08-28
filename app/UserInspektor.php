<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInspektor extends Model
{
    //use SoftDeletes;
    //use Auditable;
	
    //protected $dates = ['deleted_at'];
    
    protected $fillable = [ 
        'user_id','inspector_number','pekerjaan','kompetensi'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function inspector_group(){
        return $this->belongsTo('App\UnitInspectorCode','inspector_group_id','id');
    }
}
