<?php

use Illuminate\Database\Seeder;
use App\NcrUnit;

class LokasiNcrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit_codes = ['FAB','FIN','INC','TEST'];
        $unit_descriptions = ['Fabrikasi','Finishing','Incoming','Testing'];

        for($i = 0 ; $i<count($unit_codes);$i++){
            $unit = new NcrUnit();
            $unit->unit_code = $unit_codes[$i];
            $unit->unit_description = $unit_descriptions[$i];
            $unit->save();
        }

    }
}
