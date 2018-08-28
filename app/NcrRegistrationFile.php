<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class NcrRegistrationFile extends Model 
{
	use SoftDeletes;
    //use Auditable;
	
    protected $dates = ['deleted_at'];
    
    protected $fillable = [ 
        'ncr_registration_id','ncr_registration_upload'
    ];

    public function product()
    {
        return $this->belongsTo('App\NcrRegistration');
    }

    public function getNcrRegistrationUploadAttribute($ncr_registration_upload)
    {
        if (Storage::exists($ncr_registration_upload)) {
            return base64_encode(Storage::get($ncr_registration_upload));
        }
        return $ncr_registration_upload;
    }
}
