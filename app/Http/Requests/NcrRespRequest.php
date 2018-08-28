<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;
use App\UserInspektor;
use App\UnitInspectorCode;

class NcrRespRequest extends FormRequest
{
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
 
        if ($ui_code->ui_code == 'INC' || $ui_code->ui_code == 'SUB'){
            return [
                'problem_description' => 'required',
                // 'corrective_act' => 'required',   
                // 'preventive_act' => 'required', 
                // 'corrective_target_date' => 'required',
                // 'preventive_target_date' => 'required', 
                'disp_unit_id' => 'exists:unit_dispositions,id',
                'file_bukti.*' => 'image|mimes:jpeg,bmp,png',
                'problem_id.*' => 'exists:problem_sources,id'
            ];
        } else{
            return [
                'problem_description' => 'required',
                'corrective_act' => 'required',   
                'preventive_act' => 'required', 
                'corrective_est_date' => 'required',
                'preventive_est_date' => 'required', 
                'disp_unit_id' => 'exists:unit_dispositions,id',
                'file_bukti.*' => 'image|mimes:jpeg,bmp,png',
                'problem_id.*' => 'exists:problem_sources,id'
            ];
        }
        
        return $rules;
    }
}
