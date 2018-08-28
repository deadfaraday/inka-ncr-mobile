<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocReferenceDivision extends Model
{
    protected $dates = ['deleted_at'];

    protected $fillable = [ 
        'doc_number_head','unit_id','description'
    ];

    public function unit()
    {
        return $this->belongsTo('App\Division','unit_id','id');
    }
}
