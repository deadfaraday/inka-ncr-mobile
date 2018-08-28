<?php

use Illuminate\Database\Seeder;
use App\NcrRegistration;
use App\Division;
use App\User;

class AdminPic_NcrOld_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_ncr = NcrRegistration::whereNull('id_pic_respon')->get();
        $success = 0;
        $failed = 0;
        $list_succes = array();
        $list_failed = array();

        foreach($list_ncr as $ncr){
            $pic_id = $this->getAdminPic($ncr->division_id);
            if(!is_null($pic_id))
            {
                //dd($pic_id);
                $ncr->id_pic_respon = $pic_id;
                $ncr->save();
                $success++;
                array_push($list_succes, $ncr->no_reg_ncr);
            }else{
                $failed++;
                array_push($list_succes, $ncr->no_reg_ncr);
                continue;
            }
        }
        dd($success, $failed,$list_succes,$list_failed);
    }

    public function getAdminPic($unit_id){
        if($unit_id == 48){
            $pic_id = User::select('id')->where('nip','admin_logistik')->first();            
            return $pic_id->id;
        }

        $unit_id = Division::select('id','parent','division_name')->where('id',$unit_id)->first();
        
        while(true){
            if($unit_id->parent == 1||$unit_id->parent == 2||
                    $unit_id->parent == 3||$unit_id->parent == 4||
                    $unit_id->parent == 5) // yang disini berarti divisi
                break;
            else
            {
                $unit_id = Division::select('id','parent','division_name')->where('id',$unit_id->parent)->first();    
                
                if(is_null($unit_id))
                {
                    return null;
                }
            }     
        }

        if(!is_null($unit_id)){
            if($unit_id->id == 11)
                $pic_id = User::select('id')->where('nip','admin_logistik')->first();            
            elseif($unit_id->id == 15)
                $pic_id = User::select('id')->where('nip','admin_fabrikasi')->first();
            elseif($unit_id->id == 16)
                $pic_id = User::select('id')->where('nip','admin_fabrikasi')->first();
            else
                return null;

            return $pic_id->id;
        }else{
            return null;
        }
         

    }
}
