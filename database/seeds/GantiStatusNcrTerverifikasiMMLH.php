<?php

use Illuminate\Database\Seeder;
use App\AuditorVerification;
use App\NcrRegistration;

class GantiStatusNcrTerverifikasiMMLH extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ver_mmlh = AuditorVerification::get();

        foreach($ver_mmlh as $ver){
            $ncr = NcrRegistration::find($ver->reg_ncr_id);
            $ncr->is_ver_auditor= $ver->ver_result_id;
            $ncr->save(); 
        }
    }
}
