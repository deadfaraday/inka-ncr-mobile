<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class NcrResponseFile extends Model
{
  use SoftDeletes;
  
  protected $dates = ['deleted_at'];
  
  protected $fillable = [ 
    'response_id','ncr_response_upload'
  ];

  public function ncr_response(){
    return $this->belongsTo('App\NcrResponse','response_id','id');
  }

  public function getNcrResponseUploadAttribute($ncr_response_upload)
  {
    if (Storage::exists($ncr_response_upload)) {
      return base64_encode(Storage::get($ncr_response_upload));
    }
    return $ncr_response_upload;
  }
}
