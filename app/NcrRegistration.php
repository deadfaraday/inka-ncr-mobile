<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;/*
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;*/

class NcrRegistration extends Model 
{
	use SoftDeletes;
    //use Auditable;

    protected $dates = ['deleted_at'];
    protected $fillable = [ 
        'no_reg_ncr','user_id','process_name','reference_inspection','description_incompatibility',
        'product_identity_id','master_project_id','division_id','ui_code_id','vendor_name',
        'master_product_id','disposition_inspector_id','publish_date','completion_target',
        'incompatibility_category_id','person_in_charge','is_ver_inspector','is_ver_auditor',
        'is_cancel','id_pic_respon','doc_reference_id','doc_reference', 'lat', 'long', 'acuan_id', 'acuan_po'
    ];

    public function product_identity()
    {
        return $this->belongsTo('App\ProductIdentity','product_identity_id','id');
    }

    public function project()
    {
        return $this->belongsTo('App\MasterProject','master_project_id','id');
    }

    public function division()
    {
        return $this->belongsTo('App\Division','division_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function product()
    {
        return $this->belongsTo('App\MasterProduct','master_product_id','id');
    }

    public function disposition_inspector()
    {
        return $this->belongsTo('App\DispositionInspector');
    }

    public function ncr_reg_file()
    {
        return $this->hasMany('App\NcrRegistrationFile');
    }

    public function inc_category(){
        return $this->belongsTo('App\IncompatibilityCategory','incompatibility_category_id','id');
    }
}
