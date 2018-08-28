<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MrbDisposition extends Model
{
    protected $dates = ['deleted_at'];
    
    protected $fillable = [ 
        'description'
    ];
 
}
