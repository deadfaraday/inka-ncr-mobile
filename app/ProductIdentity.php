<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ProductIdentity extends Model implements AuditableContract
{
	use SoftDeletes;
    use Auditable;
	
    protected $dates = ['deleted_at'];
    
    protected $fillable = [ 
        'identity_description'
    ];

    public function product()
    {
        return $this->hasMany('App\NcrRegistration');
    }
}
