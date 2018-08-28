<?php

namespace App\Helper;

use Illuminate\Http\Request;
use App\NcrRegistration;
use App\NcrResponse;
use App\MasterProject;
use App\UnitInspectorCode;
use Carbon\Carbon;
use App\IncompatibilityCategory;
use App\MasterProduct;
use App\Division;
use App\UnitDisposition;
use App\ProblemSource;
use App\ResponseProblem;
use App\InspectorVerification;

use Session;

class DashboardHelper
{   
    public function getDashboardData($month, $year)
    {
        $amount_ncr_data = new \StdCLass();

        if ($month != 'all') {
            $amount_ncr = NCRRegistration::whereNull('is_cancel')
            ->whereRaw('month(publish_date) = ' . $month)
            ->whereRaw('year(publish_date) = ' .$year)
            ->count();

            $amount_ncr_data->jumlah = $amount_ncr;
            $amount_ncr_data->label = 'Jumlah NCR';

            $ncr_reg_data = new \stdClass();
            $amount_reg = NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('month(publish_date) = ' . $month)
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', 0)
                        ->where('is_ver_inspector', 0)
                        ->where('is_ver_auditor', 0)
                        ->whereNull('is_cancel')->count();

            $ncr_reg_data->jumlah = $amount_reg;
            $ncr_reg_data->label = 'NCR Belum Mendapatkan Tindak Lanjut';

            $ncr_resp_data = new \stdClass();
            $amount_resp = NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('month(publish_date) = ' . $month)
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', 1)
                        ->where('is_ver_inspector', 0)
                        ->where('is_ver_auditor', 0)
                        ->whereNull('is_cancel')->count();

            $ncr_resp_data->jumlah = $amount_resp;
            $ncr_resp_data->label = 'NCR Belum Terverifikasi Inspektor';

            $ncr_ver_inspector= new \stdClass();
            $amount_ver_ins = NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('month(publish_date) = ' . $month)
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', 1)
                        ->where('is_ver_inspector', 1)
                        ->where('is_ver_auditor', 0)
                        ->whereNull('is_cancel')->count();

            $ncr_ver_inspector->jumlah = $amount_ver_ins;
            $ncr_ver_inspector->label = 'NCR Telah Terverifikasi oleh Inspektor';

            $ncr_ver_auditor = new \stdClass();
            $amount_ver_auditor = NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('month(publish_date) = ' . $month)
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', 1)
                        ->where('is_ver_inspector', 1)
                        ->where('is_ver_auditor', 1)
                        ->whereNull('is_cancel')->count();

            $ncr_ver_auditor->jumlah = $amount_ver_auditor;
            $ncr_ver_auditor->label = 'NCR terverifikasi oleh MMLH';

            $resume_ncr_data = new \stdClass();
            $resume_ncr_data->total = $amount_ncr_data;
            $resume_ncr_data->registrasi = $ncr_reg_data;
            $resume_ncr_data->response = $ncr_resp_data;
            $resume_ncr_data->ver_inspector = $ncr_ver_inspector;
            $resume_ncr_data->ver_auditor = $ncr_ver_auditor;
        } else {
            $amount_ncr = NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->count();

            $amount_ncr_data->jumlah = $amount_ncr;
            $amount_ncr_data->label = 'Jumlah NCR';

            $ncr_reg_data = new \stdClass();
            $amount_reg = NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', 0)
                        ->where('is_ver_inspector', 0)
                        ->where('is_ver_auditor', 0)->count();

            $ncr_reg_data->jumlah = $amount_reg;
            $ncr_reg_data->label = 'NCR Belum Mendapatkan Tindak Lanjut';

            $ncr_resp_data = new \stdClass();
            $amount_resp = NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', 1)
                        ->where('is_ver_inspector', 0)
                        ->where('is_ver_auditor', 0)->count();

            $ncr_resp_data->jumlah = $amount_resp;
            $ncr_resp_data->label = 'NCR Belum Terverifikasi Inspektor';

            $ncr_ver_inspector= new \stdClass();
            $amount_ver_ins = NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', 1)
                        ->where('is_ver_inspector', 1)
                        ->where('is_ver_auditor', 0)->count();

            $ncr_ver_inspector->jumlah = $amount_ver_ins;
            $ncr_ver_inspector->label = 'NCR telah terverifikasi oleh Inspektor';

            $ncr_ver_auditor = new \stdClass();
            $amount_ver_auditor = NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', 1)
                        ->where('is_ver_inspector', 1)
                        ->where('is_ver_auditor', 1)->count();

            $ncr_ver_auditor->jumlah = $amount_ver_auditor;
            $ncr_ver_auditor->label = 'NCR terverifikasi oleh MMLH';

            $resume_ncr_data = new \stdClass();
            $resume_ncr_data->total = $amount_ncr_data;
            $resume_ncr_data->registrasi = $ncr_reg_data;
            $resume_ncr_data->response = $ncr_resp_data;
            $resume_ncr_data->ver_inspector = $ncr_ver_inspector;
            $resume_ncr_data->ver_auditor = $ncr_ver_auditor;
        }
        return $resume_ncr_data;
    }

    public function getNCRProject($month, $year)
    {
        //dd($month);
        if ($month == 'all') {
            $ncr_project = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->distinct()->get(['master_project_id']);

            $projects = MasterProject::select('id', 'project_code', 'project_description')
                        ->whereIn('id', $ncr_project->pluck('master_project_id'))->get();

            $ins_group = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->distinct()->get(['ui_code_id']);

            $inspector_groups = UnitInspectorCode::select('id', 'ui_code', 'ui_description')
                            ->whereIn('id', $ins_group->pluck('ui_code_id'))->get();

            $data_project_ui = array();
            $label_project_ui = array();

            foreach ($inspector_groups as $group) {
                $ui_code = array();
                $ui_name = $group->ui_code;

                foreach ($projects as $project) {
                    $jumlah = NCRRegistration::select('id')->whereNull('is_cancel')
                            ->whereRaw('year(publish_date) = ' .$year)
                            ->where('master_project_id', $project->id)
                            ->where('ui_code_id', $group->id)
                            ->count();
                    array_push($ui_code, $jumlah);
                }
                array_push($data_project_ui, $ui_code);
                array_push($label_project_ui, $ui_name);
            }

            $background_color = ['rgba(0, 166, 90, 0.8)','rgba(219, 139, 11, 0.8)','rgba(221, 75, 57, 0.8)','rgba(53, 124, 165, 0.8)','rgba(2, 100, 140, 0.8)','rgba(90, 180, 65, 0.8)'];
            $border_color = ['rgba(0, 166, 90, 1)','rgba(219, 139, 11, 1)','rgba(221, 75, 57, 1)', 'rgba(53, 124, 165, 1)','rgba(2, 100, 140,1)','rgba(90, 180, 65, 1)'];

            $data= array();

            for ($i=0; $i<count($label_project_ui); $i++) {
                $data[$i]['label'] = $label_project_ui[$i];
                $data[$i]['data'] = $data_project_ui[$i];

                for ($project=0; $project<count($projects); $project++) {
                    $data[$i]['backgroundColor'][$project] = $background_color[$i];
                    $data[$i]['borderColor'][$project] = $border_color[$i];
                }
                $data[$i]['borderWidth'] = 2;
            }
            // dd($data);
            $data_project_code = array();
            $data_project_desc = array();

            foreach ($projects as $project) {
            // array_push($data_project_code,$project->project_code);
                array_push($data_project_desc, $project->project_description . ' - ' . $project->project_code);
            }

            $result_data = collect([$data, $data_project_desc]);
            return $result_data;
        } else {
            //dd('hello');
            $ncr_project = NCRRegistration::whereNull('is_cancel')
            ->whereRaw('month(publish_date) = ' . $month)
            ->whereRaw('year(publish_date) = ' .$year)
            ->distinct()->get(['master_project_id']);

            $projects = MasterProject::select('id', 'project_code', 'project_description')
                        ->whereIn('id', $ncr_project->pluck('master_project_id'))->get();

            $ins_group = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('month(publish_date) = ' . $month)
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->distinct()->get(['ui_code_id']);

            $inspector_groups = UnitInspectorCode::select('id', 'ui_code', 'ui_description')
                            ->whereIn('id', $ins_group->pluck('ui_code_id'))->get();

            $data_project_ui = array();
            $label_project_ui = array();

            foreach ($inspector_groups as $group) {
                $ui_code = array();
                $ui_name = $group->ui_code;

                foreach ($projects as $project) {
                    $jumlah = NCRRegistration::select('id')->whereNull('is_cancel')
                            ->whereRaw('month(publish_date) = ' . $month)
                            ->whereRaw('year(publish_date) = ' .$year)
                            ->where('master_project_id', $project->id)
                            ->where('ui_code_id', $group->id)
                            ->count();
                    array_push($ui_code, $jumlah);
                }
                array_push($data_project_ui, $ui_code);
                array_push($label_project_ui, $ui_name);
            }

            $background_color = ['rgba(0, 166, 90, 0.8)','rgba(219, 139, 11, 0.8)','rgba(221, 75, 57, 0.8)','rgba(53, 124, 165, 0.8)','rgba(2, 100, 140, 0.8)','rgba(90, 180, 65, 0.8)'];
            $border_color = ['rgba(0, 166, 90, 1)','rgba(219, 139, 11, 1)','rgba(221, 75, 57, 1)', 'rgba(53, 124, 165, 1)','rgba(2, 100, 140,1)','rgba(90, 180, 65, 1)'];

            $data= array();

            for ($i=0; $i<count($label_project_ui); $i++) {
                $data[$i]['label'] = $label_project_ui[$i];
                $data[$i]['data'] = $data_project_ui[$i];

                for ($project=0; $project<count($projects); $project++) {
                    $data[$i]['backgroundColor'][$project] = $background_color[$i];
                    $data[$i]['borderColor'][$project] = $border_color[$i];
                }

                $data[$i]['borderWidth'] = 2;
            }
            // dd($data);
            $data_project_code = array();
            $data_project_desc = array();

            foreach ($projects as $project) {
                array_push($data_project_desc, $project->project_description . ' - ' . $project->project_code);
            }

            $result_data = collect([$data, $data_project_desc]);
            return $result_data;
        }
    }

    public function getNCRProjectDtl($month,$year,$response,$inspector,$auditor)
    {
        if ($month == 'all') {
            $ncr_project = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->where('is_response', $response)
                    ->where('is_ver_inspector', $inspector)
                    ->where('is_ver_auditor', $auditor)
                    ->distinct()->get(['master_project_id']);

            $projects = MasterProject::select('id', 'project_code', 'project_description')
                        ->whereIn('id', $ncr_project->pluck('master_project_id'))->get();

            $ins_group = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->where('is_response', $response)
                    ->where('is_ver_inspector', $inspector)
                    ->where('is_ver_auditor', $auditor)
                    ->distinct()->get(['ui_code_id']);

            $inspector_groups = UnitInspectorCode::select('id', 'ui_code', 'ui_description')
                            ->whereIn('id', $ins_group->pluck('ui_code_id'))->get();

            $data_project_ui = array();
            $label_project_ui = array();

            foreach ($inspector_groups as $group) {
                $ui_code = array();
                $ui_name = $group->ui_code;

                foreach ($projects as $project) {
                    $jumlah = NCRRegistration::select('id')->whereNull('is_cancel')
                            ->whereRaw('year(publish_date) = ' .$year)
                            
                            ->where('is_response', $response)
                            ->where('is_ver_inspector', $inspector)
                            ->where('is_ver_auditor', $auditor)

                            ->where('master_project_id', $project->id)
                            ->where('ui_code_id', $group->id)
                            ->count();
                    array_push($ui_code, $jumlah);
                }
                array_push($data_project_ui, $ui_code);
                array_push($label_project_ui, $ui_name);
            }

            $background_color = ['rgba(0, 166, 90, 0.8)','rgba(219, 139, 11, 0.8)','rgba(221, 75, 57, 0.8)','rgba(53, 124, 165, 0.8)','rgba(2, 100, 140, 0.8)','rgba(90, 180, 65, 0.8)'];
            $border_color = ['rgba(0, 166, 90, 1)','rgba(219, 139, 11, 1)','rgba(221, 75, 57, 1)', 'rgba(53, 124, 165, 1)','rgba(2, 100, 140,1)','rgba(90, 180, 65, 1)'];

            $data= array();

            for ($i=0; $i<count($label_project_ui); $i++) {
                $data[$i]['label'] = $label_project_ui[$i];
                $data[$i]['data'] = $data_project_ui[$i];

                for ($project=0; $project<count($projects); $project++) {
                    $data[$i]['backgroundColor'][$project] = $background_color[$i];
                    $data[$i]['borderColor'][$project] = $border_color[$i];
                }
                $data[$i]['borderWidth'] = 2;
            }

            $data_project_code = array();
            $data_project_desc = array();

            foreach ($projects as $project) {
                array_push($data_project_desc, $project->project_description . ' - ' . $project->project_code);
            }

            $result_data = collect([$data, $data_project_desc]);
            return $result_data;
        } else {

            $ncr_project = NCRRegistration::whereNull('is_cancel')                
                ->where('is_response', $response)
                ->where('is_ver_inspector', $inspector)
                ->where('is_ver_auditor', $auditor)
                ->whereRaw('month(publish_date) = ' . $month)
                ->whereRaw('year(publish_date) = ' .$year)
                ->distinct()->get(['master_project_id']);

            $projects = MasterProject::select('id', 'project_code', 'project_description')
                        ->whereIn('id', $ncr_project->pluck('master_project_id'))->get();

            $ins_group = NCRRegistration::whereNull('is_cancel')
                    ->where('is_response', $response)
                    ->where('is_ver_inspector', $inspector)
                    ->where('is_ver_auditor', $auditor)
                    ->whereRaw('month(publish_date) = ' . $month)
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->distinct()->get(['ui_code_id']);

            $inspector_groups = UnitInspectorCode::select('id', 'ui_code', 'ui_description')
                            ->whereIn('id', $ins_group->pluck('ui_code_id'))->get();

            $data_project_ui = array();
            $label_project_ui = array();

            foreach ($inspector_groups as $group) {
                $ui_code = array();
                $ui_name = $group->ui_code;

                foreach ($projects as $project) {
                    $jumlah = NCRRegistration::select('id')->whereNull('is_cancel')
                            ->whereRaw('month(publish_date) = ' . $month)
                            ->whereRaw('year(publish_date) = ' .$year)
                            ->where('is_response', $response)
                            ->where('is_ver_inspector', $inspector)
                            ->where('is_ver_auditor', $auditor)        
                            ->where('master_project_id', $project->id)
                            ->where('ui_code_id', $group->id)
                            ->count();
                    array_push($ui_code, $jumlah);
                }
                array_push($data_project_ui, $ui_code);
                array_push($label_project_ui, $ui_name);
            }

            $background_color = ['rgba(0, 166, 90, 0.8)','rgba(219, 139, 11, 0.8)','rgba(221, 75, 57, 0.8)','rgba(53, 124, 165, 0.8)','rgba(2, 100, 140, 0.8)','rgba(90, 180, 65, 0.8)'];
            $border_color = ['rgba(0, 166, 90, 1)','rgba(219, 139, 11, 1)','rgba(221, 75, 57, 1)', 'rgba(53, 124, 165, 1)','rgba(2, 100, 140,1)','rgba(90, 180, 65, 1)'];

            $data= array();

            for ($i=0; $i<count($label_project_ui); $i++) {
                $data[$i]['label'] = $label_project_ui[$i];
                $data[$i]['data'] = $data_project_ui[$i];

                for ($project=0; $project<count($projects); $project++) {
                    $data[$i]['backgroundColor'][$project] = $background_color[$i];
                    $data[$i]['borderColor'][$project] = $border_color[$i];
                }

                $data[$i]['borderWidth'] = 2;
            }

            $data_project_code = array();
            $data_project_desc = array();

            foreach ($projects as $project) {
                array_push($data_project_desc, $project->project_description . ' - ' . $project->project_code);
            }

            $result_data = collect([$data, $data_project_desc]);
            return $result_data;
        }
    }

    public function getIncompatibilityDtl($month,$year,$response,$inspector,$auditor){
        $result= array();
        
        if ($month == 'all') {
            $mayor_cat = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->where('incompatibility_category_id',2)
                    ->where('is_response', $response)
                    ->where('is_ver_inspector', $inspector)
                    ->where('is_ver_auditor', $auditor)
                    ->count();
            array_push($result,$mayor_cat);
            $minor_cat = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->where('incompatibility_category_id',1)
                    ->where('is_response', $response)
                    ->where('is_ver_inspector', $inspector)
                    ->where('is_ver_auditor', $auditor)
                    ->count();
            array_push($result,$minor_cat);
        } else{
            $mayor_cat = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->whereRaw('month(publish_date) = ' .$month)
                    ->where('incompatibility_category_id',2)
                    ->where('is_response', $response)
                    ->where('is_ver_inspector', $inspector)
                    ->where('is_ver_auditor', $auditor)
                    ->count();
            array_push($result,$mayor_cat);
            $minor_cat = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->whereRaw('month(publish_date) = ' .$month)
                    ->where('incompatibility_category_id',1)
                    ->where('is_response', $response)
                    ->where('is_ver_inspector', $inspector)
                    ->where('is_ver_auditor', $auditor)
                    ->count();
            array_push($result,$minor_cat);
        }
        return $result;
    }

    public function getVerifikasiInspektorDtl($month,$year,$response,$inspector,$auditor){
        $result= array();
        
        if ($month == 'all') {
            $ncr = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->where('is_response', $response)
                    ->where('is_ver_inspector', $inspector)
                    ->where('is_ver_auditor', $auditor)
                    ->get();
            $ver_efektif = InspectorVerification::whereIn('reg_id', $ncr->pluck('id'))
                ->where('verification_result_id',1)->get();
            $ver_not_efektif = InspectorVerification::whereIn('reg_id', $ncr->pluck('id'))
                ->whereNotin('reg_id', $ver_efektif->pluck('reg_id'))
                ->where('verification_result_id',2)->count();

            

            // dd($ncr->pluck('id'),$ver_efektif->pluck('reg_id'), $ver_not_efektif->pluck('reg_id'));
            $ver_efektif = $ver_efektif->count();

            array_push($result,$ver_efektif);
            array_push($result,$ver_not_efektif);
           
        } else{
            $ncr = NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    ->whereMonth('publish_date', $month)
                    ->where('is_response', $response)
                    ->where('is_ver_inspector', $inspector)
                    ->where('is_ver_auditor', $auditor)
                    ->get();
            $ver_efektif = InspectorVerification::whereIn('reg_id', $ncr->pluck('id'))
                ->where('verification_result_id',1)->get();
            $ver_not_efektif = InspectorVerification::whereIn('reg_id', $ncr->pluck('id'))
                ->whereNotin('reg_id', $ver_efektif->pluck('reg_id'))
                ->where('verification_result_id',2)->count();
            $ver_efektif = $ver_efektif->count();
                     
            array_push($result,$ver_efektif);
            array_push($result,$ver_not_efektif);           
        }
        return $result;
    }


    public function getJenisProdukDtl($month,$year,$response,$inspector,$auditor){
        $color_background = ['rgba(244, 162, 97, 0.8)','rgba(36, 123, 160, 0.8)','rgba(229, 89, 52, 0.8)',
            'rgba(2, 199, 154, 0.8)' , 'rgba(233, 196, 106, 0.8)','rgba(255, 244, 102, 0.8)',
            'rgba(155, 197, 61, 0.8)','rgba(0, 166, 150, 0.8)', 'rgba(231, 111, 81, 0.8)',
            'rgba(112, 193, 179, 0.8)' , 'rgba(250, 121, 33, 0.8)','rgba(242, 95, 92, 0.8)','rgba(253, 231, 76, 0.8)'
        ];

        $color_border = ['rgba(244, 162, 97, 1)','rgba(36, 123, 160, 1)','rgba(229, 89, 52, 1)',
                'rgba(2, 199, 154, 1)' , 'rgba(233, 196, 106, 1)','rgba(255, 244, 102, 1)',
                'rgba(155, 197, 61, 1)','rgba(0, 166, 150, 1)', 'rgba(231, 111, 81, 1)',
                'rgba(112, 193, 179, 1)' , 'rgba(250, 121, 33, 1)','rgba(242, 95, 92, 1)','rgba(253, 231, 76, 1)'
                ];

                
        $products= MasterProduct::select('id','product_description')->get();
        
        $data_graph_products = array();
        $jenis_produk = array();

        if($month=='all'){
            foreach($products as $product){
                $jumlah= NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', $response)
                        ->where('is_ver_inspector', $inspector)
                        ->where('is_ver_auditor', $auditor)    
                        ->where('master_product_id',$product->id)
                        ->count();
                array_push($data_graph_products,$jumlah);        
                array_push($jenis_produk,$product->product_description);
            }
        }else{
            foreach($products as $product){

                $jumlah= NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->whereRaw('month(publish_date) ='.$month)
                        ->where('is_response', $response)
                        ->where('is_ver_inspector', $inspector)
                        ->where('is_ver_auditor', $auditor)    
                        ->where('master_product_id',$product->id)
                        ->count();

                array_push($data_graph_products,$jumlah);        
                array_push($jenis_produk,$product->product_description);
            }
        }
       
        $data_graph_reg_ncr = new \stdClass();
        $data_graph_reg_ncr->labels = $jenis_produk;
        $data_graph_reg_ncr->datasets['data'] = $data_graph_products;
        $data_graph_reg_ncr->datasets['backgroundColor'] = $color_background;
        $data_graph_reg_ncr->datasets['borderColor'] = $color_border;
        
        return $data_graph_reg_ncr;
    }

    public function getUnitDtl($month,$year,$response,$inspector,$auditor){
       
        $color_background = ['rgba(244, 162, 97, 0.8)','rgba(36, 123, 160, 0.8)','rgba(229, 89, 52, 0.8)',
            'rgba(2, 199, 154, 0.8)' , 'rgba(233, 196, 106, 0.8)','rgba(255, 244, 102, 0.8)',
            'rgba(155, 197, 61, 0.8)','rgba(0, 166, 150, 0.8)', 'rgba(231, 111, 81, 0.8)',
            'rgba(112, 193, 179, 0.8)' , 'rgba(250, 121, 33, 0.8)','rgba(242, 95, 92, 0.8)','rgba(253, 231, 76, 0.8)'
        ];

        $color_border = ['rgba(244, 162, 97, 1)','rgba(36, 123, 160, 1)','rgba(229, 89, 52, 1)',
            'rgba(2, 199, 154, 1)' , 'rgba(233, 196, 106, 1)','rgba(255, 244, 102, 1)',
            'rgba(155, 197, 61, 1)','rgba(0, 166, 150, 1)', 'rgba(231, 111, 81, 1)',
            'rgba(112, 193, 179, 1)' , 'rgba(250, 121, 33, 1)','rgba(242, 95, 92, 1)','rgba(253, 231, 76, 1)'
        ];

       
        $unit_name = array();
        $data_graph_unit = array();

        if($month=='all'){
            $lokasi=  NCRRegistration::whereNull('is_cancel')
                ->whereRaw('year(publish_date) = ' .$year)
                ->where('is_response', $response)
                ->where('is_ver_inspector', $inspector)
                ->where('is_ver_auditor', $auditor)
                ->distinct()->get(['division_id']);
                
            $units = Division::select('id','division_name')
                        ->whereIn('id',$lokasi->pluck('division_id'))->get();


            foreach($units as $unit){
                $jumlah= NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', $response)
                        ->where('is_ver_inspector', $inspector)
                        ->where('is_ver_auditor', $auditor)    
                        ->where('division_id',$unit->id)
                        ->count();
                array_push($data_graph_unit,$jumlah);      
                array_push($unit_name,$unit->division_name);
                
            }
        }else{
            $lokasi=  NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('month(publish_date) ='.$month)
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', $response)
                        ->where('is_ver_inspector', $inspector)
                        ->where('is_ver_auditor', $auditor)
                        ->distinct()->get(['division_id']);
            
            $units = Division::select('id','division_name')
                        ->whereIn('id',$lokasi->pluck('division_id'))->get();

            foreach($units as $unit){
            
                $jumlah= NCRRegistration::whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->whereRaw('month(publish_date) ='.$month)
                        ->where('is_response', $response)
                        ->where('is_ver_inspector', $inspector)
                        ->where('is_ver_auditor', $auditor)    
                        ->where('division_id',$unit->id)
                        ->count();
                array_push($data_graph_unit,$jumlah);      
                array_push($unit_name,$unit->division_name);
            }
        }
        

        $data_graph_reg_ncr = new \stdClass();
        $data_graph_reg_ncr->labels = $unit_name;
        $data_graph_reg_ncr->datasets['data'] = $data_graph_unit;
        $data_graph_reg_ncr->datasets['backgroundColor'] = $color_background;
        $data_graph_reg_ncr->datasets['borderColor'] = $color_border;

        // dd($data_graph_reg_ncr);
        return $data_graph_reg_ncr;
    }

    public function getInspektorDtl($month,$year, $response,$inspector,$auditor){
        
        $color_background = ['rgba(244, 162, 97, 0.8)','rgba(36, 123, 160, 0.8)','rgba(229, 89, 52, 0.8)',
        'rgba(2, 199, 154, 0.8)' , 'rgba(233, 196, 106, 0.8)','rgba(255, 244, 102, 0.8)',
        'rgba(155, 197, 61, 0.8)','rgba(0, 166, 150, 0.8)', 'rgba(231, 111, 81, 0.8)',
        'rgba(112, 193, 179, 0.8)' , 'rgba(250, 121, 33, 0.8)','rgba(242, 95, 92, 0.8)','rgba(253, 231, 76, 0.8)'
        ];

        $color_border = ['rgba(244, 162, 97, 1)','rgba(36, 123, 160, 1)','rgba(229, 89, 52, 1)',
            'rgba(2, 199, 154, 1)' , 'rgba(233, 196, 106, 1)','rgba(255, 244, 102, 1)',
            'rgba(155, 197, 61, 1)','rgba(0, 166, 150, 1)', 'rgba(231, 111, 81, 1)',
            'rgba(112, 193, 179, 1)' , 'rgba(250, 121, 33, 1)','rgba(242, 95, 92, 1)','rgba(253, 231, 76, 1)'
        ];

        
        $inspectors=  NCRRegistration::with('user')->whereNull('is_cancel')
            ->whereRaw('year(publish_date) = ' .$year)
            ->where('is_response', $response)
            ->where('is_ver_inspector', $inspector)
            ->where('is_ver_auditor', $auditor)
            ->distinct()->get(['user_id']);

        // 12 warna sudah ditentukan 
        for ($i=12;$i<count($inspectors);$i++){
            $r = rand(0,150);
            $g = rand(100,150);
            $b = rand(0,250);
            $a1 = 0.8;
            $a2 = 1;
            $background = 'rgba(' . $r . ',' .$g. ',' .$b . ',' . $a1. ')';
            $border = 'rgba(' . $r . ',' .$g. ',' .$b . ',' . $a2 . ')';
            array_push ($color_background, $background);
            array_push($color_border, $border);
        }
        

        $data_graph_inspector = array();
        $inspector_name = array();
        
        foreach($inspectors as $inspector){
            
            if($month=='all'){
                $jumlah= NCRRegistration::whereNull('is_cancel')
                    ->whereRaw('year(publish_date) = ' .$year)
                    //->whereRaw('month(publish_date) ='.$month)
                    ->where('is_response', $response)
                    ->where('is_ver_inspector', $inspector)
                    ->where('is_ver_auditor', $auditor)
                    ->where('user_id',$inspector->user_id)
                    ->count();
            } else {
                $jumlah= NCRRegistration::whereNull('is_cancel')
                ->whereRaw('year(publish_date) = ' .$year)
                ->whereRaw('month(publish_date) ='.$month)
                ->where('is_response', $response)
                ->where('is_ver_inspector', $inspector)
                ->where('is_ver_auditor', $auditor)
                ->where('user_id',$inspector->user_id)
                ->count();
            }
                

            array_push($data_graph_inspector,$jumlah);      
            array_push($inspector_name,$inspector->user->name);
        }

        $data_graph_reg_inspector = new \stdClass();
        $data_graph_reg_inspector->labels = $inspector_name;
        $data_graph_reg_inspector->datasets['data'] = $data_graph_inspector;
        $data_graph_reg_inspector->datasets['backgroundColor'] = $color_background;
        $data_graph_reg_inspector->datasets['borderColor'] = $color_border;

        return $data_graph_reg_inspector;
    }

    public function getDispUnitDtl($month,$year,$response,$inspector,$auditor){
        $color_background = ['rgba(244, 162, 97, 0.8)','rgba(36, 123, 160, 0.8)','rgba(229, 89, 52, 0.8)',
        'rgba(2, 199, 154, 0.8)' , 'rgba(233, 196, 106, 0.8)','rgba(255, 244, 102, 0.8)',
        'rgba(155, 197, 61, 0.8)','rgba(0, 166, 150, 0.8)', 'rgba(231, 111, 81, 0.8)',
        'rgba(112, 193, 179, 0.8)' , 'rgba(250, 121, 33, 0.8)','rgba(242, 95, 92, 0.8)','rgba(253, 231, 76, 0.8)'
        ];

        $color_border = ['rgba(244, 162, 97, 1)','rgba(36, 123, 160, 1)','rgba(229, 89, 52, 1)',
            'rgba(2, 199, 154, 1)' , 'rgba(233, 196, 106, 1)','rgba(255, 244, 102, 1)',
            'rgba(155, 197, 61, 1)','rgba(0, 166, 150, 1)', 'rgba(231, 111, 81, 1)',
            'rgba(112, 193, 179, 1)' , 'rgba(250, 121, 33, 1)','rgba(242, 95, 92, 1)','rgba(253, 231, 76, 1)'
        ];
        
        if($month == 'all')
        {
            if($response== 'any' && $inspector == 'any' && $auditor == 'any'){
                $ncr_reg=  NCRRegistration::select('id','no_reg_ncr','publish_date')->whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        // ->where('is_response', $response)
                        // ->where('is_ver_inspector', $inspector)
                        // ->where('is_ver_auditor', $auditor)
                        ->get();
            }else{
            $ncr_reg=  NCRRegistration::select('id','no_reg_ncr','publish_date')->whereNull('is_cancel')
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', $response)
                        ->where('is_ver_inspector', $inspector)
                        ->where('is_ver_auditor', $auditor)
                        ->get();
            }
            
        }else{
            $ncr_reg=  NCRRegistration::select('id','no_reg_ncr','publish_date')->whereNull('is_cancel')
                        ->whereRaw('month(publish_date) = ' .$month)
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', $response)
                        ->where('is_ver_inspector', $inspector)
                        ->where('is_ver_auditor', $auditor)
                        ->get();                        
        }

        $ncr_resp = NCRResponse::select('disp_unit_id')->whereIn('ncr_id', $ncr_reg->pluck('id'))
                    ->distinct()->get('disp_unit_id');
        // 
        // dd($month,$year,$ncr_reg->pluck('no_reg_ncr'),$ncr_resp);
        
        $data_graph_disp = array();
        $disposition_name = array();

        foreach($ncr_resp as $resp){
            $disp_name = UnitDisposition::select('description')->where('id',$resp->disp_unit_id)->first();
            // dd($disp_name);
            $disp_unit_count = NCRResponse::select('id')
                                ->whereIn('ncr_id', $ncr_reg->pluck('id'))
                                ->where('disp_unit_id',$resp->disp_unit_id)->count();

            
            array_push($data_graph_disp,$disp_unit_count);      
            array_push($disposition_name,$disp_name->description);
        }

        $data_graph_disp_unit = new \stdClass();
        $data_graph_disp_unit->labels = $disposition_name;
        $data_graph_disp_unit->datasets['data'] = $data_graph_disp;
        $data_graph_disp_unit->datasets['backgroundColor'] = $color_background;
        $data_graph_disp_unit->datasets['borderColor'] = $color_border;
        
        return $data_graph_disp_unit;
    }

    public function getAkarMasalahDtl($month, $year,$response,$inspector,$auditor)
    {
        $color_background = ['rgba(244, 162, 97, 0.8)','rgba(36, 123, 160, 0.8)','rgba(229, 89, 52, 0.8)',
        'rgba(2, 199, 154, 0.8)' , 'rgba(233, 196, 106, 0.8)','rgba(255, 244, 102, 0.8)',
        'rgba(155, 197, 61, 0.8)','rgba(0, 166, 150, 0.8)', 'rgba(231, 111, 81, 0.8)',
        'rgba(112, 193, 179, 0.8)' , 'rgba(250, 121, 33, 0.8)','rgba(242, 95, 92, 0.8)','rgba(253, 231, 76, 0.8)'
        ];

        $color_border = ['rgba(244, 162, 97, 1)','rgba(36, 123, 160, 1)','rgba(229, 89, 52, 1)',
            'rgba(2, 199, 154, 1)' , 'rgba(233, 196, 106, 1)','rgba(255, 244, 102, 1)',
            'rgba(155, 197, 61, 1)','rgba(0, 166, 150, 1)', 'rgba(231, 111, 81, 1)',
            'rgba(112, 193, 179, 1)' , 'rgba(250, 121, 33, 1)','rgba(242, 95, 92, 1)','rgba(253, 231, 76, 1)'
        ];

        if($month == 'all')
        {
            if($response == 'any' && $inspector == 'any' && $auditor == 'any'){
                $ncr_reg=  NCRRegistration::select('id','no_reg_ncr')->whereNull('is_cancel')
                ->whereRaw('year(publish_date) = ' .$year)
                ->get();
            }else{
                $ncr_reg=  NCRRegistration::select('id','no_reg_ncr')->whereNull('is_cancel')
                            ->whereRaw('year(publish_date) = ' .$year)
                            ->where('is_response', $response)
                            ->where('is_ver_inspector', $inspector)
                            ->where('is_ver_auditor', $auditor)
                            ->get();
            }
        }else{
            if($response == 'any' && $inspector == 'any' && $auditor == 'any'){
                $ncr_reg=  NCRRegistration::select('id','no_reg_ncr')->whereNull('is_cancel')
                        ->whereRaw('month(publish_date) = ' .$month)
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->get();
            }else{
            $ncr_reg=  NCRRegistration::select('id','no_reg_ncr')->whereNull('is_cancel')
                        ->whereRaw('month(publish_date) = ' .$month)
                        ->whereRaw('year(publish_date) = ' .$year)
                        ->where('is_response', $response)
                        ->where('is_ver_inspector', $inspector)
                        ->where('is_ver_auditor', $auditor)
                        ->get();
            }
        }
        
        $ncr_resp = NCRResponse::select('id')->whereIn('ncr_id', $ncr_reg->pluck('id'))
                       ->get();
        // dd($ncr_resp, $ncr_reg->pluck('no_reg_ncr'));
        $problem_response = ResponseProblem::select('id')->whereIn('resp_id',$ncr_resp->pluck('id'))->get();
        $data_graph_problem = array();
        $problem_data = array();

        $problem_sources = ProblemSource::select('id')->get();

        foreach($problem_sources as $problem){
        // foreach($problem_response as $problem){
            $problem_name = ProblemSource::select('description')->where('id',$problem->id)->first();
            $problem_count = ResponseProblem::select('id')
                                ->where('problem_id', $problem->id)
                                ->whereIn('resp_id',$problem_response->pluck('id'))->count();
            
            array_push($data_graph_problem,$problem_count);
            if(!is_null($problem_name))    
                array_push($problem_data,$problem_name->description);
        }
       
        $data_graph_akar_masalah = new \stdClass();
        $data_graph_akar_masalah->labels = $problem_data;
        $data_graph_akar_masalah->datasets['data'] = $data_graph_problem;
        $data_graph_akar_masalah->datasets['backgroundColor'] = $color_background;
        $data_graph_akar_masalah->datasets['borderColor'] = $color_border;
        
        return $data_graph_akar_masalah;
    }

}
