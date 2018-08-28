<?php

use Illuminate\Database\Seeder;
use App\UnitInspectorCode;

class UnitInspectorCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ui_codes = ['FAB','FIN','INC','TEST','SUB','KAL','QE','QE2'];
        $ui_descs = ['Inprocess Fabrikasi Inspection','Inprocess Finishing Inspection',
                    'Incoming Inspection','Final Testing','Subcont and Service Inspection',
                    'Unit Kalibrasi','Quality Engineering I','Quality Engineering II'];
        $div_id = [74,136,75,76,141,145,137,138];

        for($i = 0;$i<count($ui_descs);$i++){
            $ui = new UnitInspectorCode();
            $ui->division_id = $div_id[$i];
            $ui->ui_code = $ui_codes[$i];
            if($ui_codes[$i]=='FAB'||$ui_codes[$i]=='FIN'||$ui_codes[$i]=='INC'||$ui_codes[$i]=='TEST'||$ui_codes[$i]=='SUB')
                $ui->is_inspector = 1;
            $ui->ui_description = $ui_descs[$i];
            $ui->save();
        }
        
    }
}
