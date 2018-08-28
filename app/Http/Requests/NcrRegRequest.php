<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\UserInspektor;
use App\UnitInspectorCode;

class NcrRegRequest extends FormRequest
{

    //http://laraveldaily.com/upload-multiple-files-laravel-5-4/
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_id = Auth::id();
        $user_inspektor = UserInspektor::where('user_id',$user_id)->first();
        // dd($user_inspektor);
        $ui_code = UnitInspectorCode::select('ui_code')->
                    where('id',$user_inspektor->inspector_group_id)->first();

        if($ui_code->ui_code == 'INC' || $ui_code->ui_code == 'SUB'){
            return [
                'process_name'=> 'required',
                // 'reference_inspection' => 'required',
                'description_incompatibility' => 'required',
                //'product_identity_id' => 'exists:product_identities,id',
                'master_project_id' => 'required|exists:master_projects,id',
                'division_id' => 'exists:divisions,id',
                'master_product_id' => 'exists:master_products,id',
                'disposition_inspector_id' => 'required|exists:disposition_inspectors,id',
                //'completion_target' => 'required',
                //'person_in_charge' => 'required',
                'incompatibility_category_id' => 'required|exists:incompatibility_categories,id',
                // 'file_bukti.*' => 'image|mimes:jpeg,bmp,png',
                'lat' => 'required',
                'long' => 'required',
                'acuan_id' => 'required',
                'acuan_po' => 'required'
                //'default_pic' => 'exists:users,id'
            ];
        } else {
            return [
                'process_name'=> 'required',
                // 'reference_inspection' => 'required',
                'description_incompatibility' => 'required',
                //'product_identity_id' => 'exists:product_identities,id',
                'master_project_id' => 'exists:master_projects,id',
                'division_id' => 'exists:divisions,id',
                'master_product_id' => 'exists:master_products,id',
                'disposition_inspector_id' => 'exists:disposition_inspectors,id',
                'completion_target' => 'required',
                //'person_in_charge' => 'required',
                'incompatibility_category_id' => 'exists:incompatibility_categories,id',
                // 'file_bukti.*' => 'image|mimes:jpeg,bmp,png',
                //'default_pic' => 'exists:users,id'
                'lat' => 'required',
                'long' => 'required',
                'acuan_id' => 'required',
                'acuan_po' => 'required'
            ];
        }

        

        return $rules;
    }
}
