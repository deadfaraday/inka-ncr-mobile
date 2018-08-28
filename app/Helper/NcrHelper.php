<?php

namespace App\Helper;
use App\Division;
use App\User;
use App\MasterProject;

class NcrHelper
{   
    /*  
        get list of all project 
        @param --> 
        @return --> list of project
    */

    public function getListProject(){

        $project = MasterProject::get();
        
        if(count($project) <= 0){
            $list_project = collect();
            $list_project = $list_project->push(['id_project' => '' , 'label' => '']);
        }else{
            for ($i=0; $i < count($project) ; $i++){
                $id_project = $project->pluck('id')->get($i);
                $project_code = $project->pluck('project_code')->get($i);
                $project_description = $project->pluck('project_description')->get($i);
        
                $label_project = $project_code . ' : ' . $project_description;
        
                if($i==0){
                    $list_project = collect();
                    $list_project = $list_project->push(['id_project' => $id_project ,'label' => $label_project]);
                } else{
                $list_project = $list_project->push(['id_project' => $id_project ,'label' => $label_project]);
                }
            }
        }

        return $list_project;
    }



    /*  
        get list unit tujuan base on ui code
        @param --> ui code
        @return --> list of units
        @return (new) -> list of units for dropdown
    */
    public function getUnitTujuan($ui_code){
        $ui_code = $ui_code->ui_code;
        if($ui_code == 'FAB')
            $divisi = [15]; // divisi fabrikasi
        elseif($ui_code == 'FIN')
            $divisi = [16]; // divisi finishing
        elseif($ui_code ==  'INC' || $ui_code ==  'SUB')
            $divisi = [11]; // divisi logistik
        elseif($ui_code == 'TEST')
            $divisi = [16,11]; // finishing dan logistik

        $list_divisi = array();

        $index = 0;

        $all_division = collect();
        
        foreach ($divisi as $div){
            $division = Division::select('id','division_name')->where('id',$div)->get();
            // dd($division);
            $departemen = Division::select('id','division_name')->where('parent',$division->pluck('id'))->get();
            $bagian = Division::select('id','division_name')->whereIn('parent',$departemen->pluck('id'))->get();
            
            //gabungkan jadi 1
            // $division = $division->merge($departemen);
            // $division = $division->merge($bagian);

            // $all_division = $all_division->merge($division);

            // ditampilkab hanya unit/bagian saja
            $all_division = $all_division->merge($bagian);
        }

        // return $all_division;

        $unit_tujuan = $all_division;
        // siapkan dropdown untuk unit tujuan 
        if(count($unit_tujuan) <= 0){
            $list_unit = collect();
            $list_unit = $list_unit->push(['id' => '' , 'division_name' => '']);
        }else{
            for ($i=0; $i < count($unit_tujuan) ; $i++){
                $id = $unit_tujuan->pluck('id')->get($i);
                $division_name = $unit_tujuan->pluck('division_name')->get($i);
                
                if($i==0){
                    $list_unit = collect();
                    $list_unit = $list_unit->push(['id' => $id ,'division_name' => $division_name]);
                } else{
                $list_unit = $list_unit->push(['id' => $id ,'division_name' => $division_name]);
                }
            }
        }

        return $list_unit ;

    }



    
    /*
        Penentuan Lokasi Produk secara otomatis,sesuai kode inspektor
        @param --> ui code of incpektor
        @return --> product_id
    */
    public function getLokasiProduk($ui_code){
        $ui_code = $ui_code->ui_code;
     
        $product_id = null; 
        if($ui_code == 'FAB')
            $product_id = 3; // inproses fab   
        elseif($ui_code == 'FIN')
            $product_id = 2; // inproses fin 
        elseif($ui_code= 'INC' || $ui_code = 'SUB')
            $product_id = 1; // masuk 
        elseif($ui_code == 'TEST')
            $product_id = 4; // final 

        return $product_id;
    }  
    
    /*
        Fungsi untuk mendapatkan admin sesuai unit divisi yang dipilih, 
        terdapat 3 divisi yang dimungkinkan untuk dipilih:

        --> Div Finishing -> admin_finsihing
        --> Div Fabrikasi -> admin_fabrikasi
        --> Div Logistik  -> admin_logistik 

        @param --> unit_id 
        @return --> user->id
    */ 

    public function getAdminPic($unit_id){
        
        $unit_id = Division::select('id','parent','division_name')->where('id',$unit_id)->first();
        while(true){
            if($unit_id->parent == 1||$unit_id->parent == 2||
                    $unit_id->parent == 3||$unit_id->parent == 4 || $unit_id->parent == 5) // yang disini berarti divisi
                break;
            else
                $unit_id = Division::select('id','parent','division_name')->where('id',$unit_id->parent)->first();
        }

        if($unit_id->id == 11)
            $pic_id = User::select('id')->where('nip','admin_logistik')->first();            
        elseif($unit_id->id == 15)
            $pic_id = User::select('id')->where('nip','admin_fabrikasi')->first();
        elseif($unit_id->id == 16)
            $pic_id = User::select('id')->where('nip','admin_finishing')->first();
            
        if(!is_null($pic_id))
            return $pic_id->id;
        else 
            return 0;
    }
    
}
