<?php

namespace App\Services;

// use Illuminate\Support\Facades\Mail;
// use App\Mail\NcrNotifMail;
use Carbon\Carbon;
use App\NcrResponse;
use App\NcrRegistration;
use App\Division;
use App\InspectorVerification;
use App\ResponseProblem;
use App\UserInspektor;
use App\ResponseMrbUnit;
use PDF;
use App\AuditorVerification;
use App\User;

class PrintNcr
{
    public function pdf($ncr_resp_id){
        $ncr_resp = NcrResponse::with('unit_disposition','mrb_disposition','ncr_registration','ncr_registration.project','ncr_registration.product_identity'
        ,'ncr_registration.division','ncr_registration.user')->where('id',$ncr_resp_id)->first();

        //dd($ncr_resp);
        $printpdf = NcrRegistration::with('inc_category','division','user','product_identity','project','product')
        ->where('id',$ncr_resp->ncr_registration->id)->first();

        $division = Division::where('id',$printpdf->division->parent)->first();
        

        if(!is_null($printpdf->vendor_name))
        {
            //tambahkan nama vendor jika diisi
            $printpdf->division->division_name = $printpdf->division->division_name 
                .' / ' . $printpdf->vendor_name; 
        }

        // ttd 
        $unit_ncr = $printpdf->division->division_name;
        $ttd_unit = $ncr_resp->user->nip .'/'. $ncr_resp->user->name  .'/'. 'a.n Manager ' . $unit_ncr ;

        $ttd_inspektor = $printpdf->user->nip .'/'. $printpdf->user->name;

        $publish_date = Carbon::createFromFormat('Y-m-d', $printpdf->publish_date);
        $publish_date = $publish_date->format('d/m/Y');
        
        $userinspector = UserInspektor::where('user_id',$printpdf->user_id)->first();

        $resp_problem = ResponseProblem::with('ncr_response','problem_source')->where('resp_id',$ncr_resp->ncr_registration->id)->get();

        /*$resp_file = NcrResponseFile::select('id','ncr_response_upload')
            ->where('response_id',$ncr_resp->id)->get();*/
        $inspector_verification = InspectorVerification::with('ver_result')->where('reg_id',$ncr_resp->ncr_registration->id)
            ->where('resp_id',$ncr_resp->id)->first();

        $created_at = Carbon::createFromFormat('Y-m-d', $inspector_verification->publish_date);
        $created_at = $created_at->format('d/m/Y');

        $mrb_unit = ResponseMrbUnit::with('division')->where('response_id',$ncr_resp->ncr_registration->id)->get();
        $count = count($mrb_unit)-4;
        // dd($mrb_unit);
        //dd($ncr_resp, $printpdf, $resp_problem, $mrb_unit);
        $pdf = PDF::loadView('verification_inspector.pdf',compact('printpdf','userinspector','ncr_resp',
        'resp_problem','mrb_unit','count','publish_date','inspector_verification',
        'created_at','division','ttd_unit','ttd_inspektor'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->getDomPDF()->set_option("enable_php", true);
        
        return $pdf;
        
    }

    public function ncr_pdf($ncr_reg_id){
        
        $ncr_reg = NcrRegistration::with('division','user','product_identity',
                    'project','product','inc_category')
            ->where('id',$ncr_reg_id)->first();

        // dd($manager);

        // dd($manager_nip);

        $ttd_unit = null;
        $resp_problem = null;
        $ncr_resp = null;
        $inspector_verification = null;
        $inspector_ver_date = null;
        $created_at = null;
        $auditor_verification = null;
        $auditor_ver_date = null;
        $ttd_inspector_ver = null;
        $count = null;
        $mrb_unit = null;
        $manager_unit = null;


        $ttd_inspektor = $ncr_reg->user->nip .'/'. $ncr_reg->user->name;
        
        $division = Division::where('id',$ncr_reg->division->parent)->first();
        $vendor_name = null;

        // data ncr resp
        $ncr_resp = NcrResponse::with('user','unit_disposition','mrb_disposition','ncr_registration'
                        ,'ncr_registration.project','ncr_registration.product_identity',
                        'ncr_registration.division','ncr_registration.user')
                        ->where('ncr_id',$ncr_reg_id)->first();

        if(!is_null($ncr_resp))
        {
        
            // $ttd_unit = $ncr_resp->user->nip .'/'. $ncr_resp->user->name  .
            //         '/'. 'a.n Manager ' . $unit_ncr ;

            $unit_ncr = $ncr_reg->division->division_name;
            $id_unit = $ncr_reg->division_id;
            $manager_nip = Division::select('kadiv_nip')->where('id',$id_unit)->first();
            
            if(!is_null($manager_nip))
            {
                $manager_unit = User::select('name','nip')->where('nip',$manager_nip->kadiv_nip)->first();
        
                if(!is_null($manager_unit))
                    $ttd_unit = $manager_unit->name . '/' . $manager_unit->nip;
            }
            
            
            $resp_problem = ResponseProblem::with('ncr_response','problem_source')
                    ->where('resp_id',$ncr_resp->id)->get();

            $inspector_verification = InspectorVerification::with('ver_result')->
                        where('reg_id',$ncr_resp->ncr_registration->id)->
                        where('resp_id',$ncr_resp->id)->first();
            
            if(!is_null($inspector_verification)){
                $inspector_ver_date = Carbon::createFromFormat('Y-m-d', $inspector_verification->publish_date);
                $inspector_ver_date = $inspector_ver_date->format('d/m/Y');

                $ttd_inspector_ver = $ncr_reg->user->nip .' pada: '.  $inspector_ver_date ;

                $auditor_verification = AuditorVerification::with('ver_result','auditor')->where('reg_ncr_id',$ncr_resp->ncr_registration->id)
                    ->where('resp_ncr_id',$ncr_resp->id)->first();


                if(!is_null($auditor_verification))
                {
                    $auditor_ver_date = Carbon::createFromFormat('Y-m-d', $auditor_verification->publish_date);
                    $auditor_ver_date = $auditor_ver_date->format('d/m/Y');

                    $ttd_auditor_ver = $auditor_verification->auditor->nip .' pada: '.  $auditor_ver_date ;
                    // dd($ttd_auditor_ver);
                }
            }

            
            $mrb_unit = ResponseMrbUnit::with('division')->where('response_id',$ncr_resp->id)->get();
            
            if(!is_null($mrb_unit)){
                $count = count($mrb_unit)-4;   
            }
            // dd($mrb_unit);
        }

        // dd($mrb_unit);
        if(!is_null($ncr_reg->vendor_name))
        {
            $vendor_name = $ncr_reg->vendor_name; 
        }

        $userinspector = UserInspektor::where('user_id',$ncr_reg->user_id)->first();
        
        $publish_date = Carbon::createFromFormat('Y-m-d', $ncr_reg->publish_date);
        $publish_date = $publish_date->format('d/m/Y');

        if(!is_null($ncr_reg->completion_target)){
            $completion_target = Carbon::createFromFormat('Y-m-d', $ncr_reg->completion_target);
            $completion_target = $completion_target->format('d/m/Y');
        }
        else
            $completion_target = '';

        $splitter_by = ['&nbsp;'];
    
        $pdf = PDF::loadView('print_ncr.pdf',compact('ncr_reg','userinspector','publish_date',
                'completion_target','division','vendor_name',
                'ttd_inspektor','ttd_unit','resp_problem','ncr_resp','inspector_verification',
                'auditor_verification','created_at','inspector_ver_date','auditor_ver_date',
                'ttd_inspector_ver','ttd_auditor_ver','splitter_by', 'manager_unit',
                'mrb_unit','count'));
        
        $pdf->setPaper('A4', 'portrait');
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf;
        // return $pdf->stream('index.pdf');
        // return $pdf->download($printpdf->no_reg_ncr.'.pdf');
    }
}