<?php

use Illuminate\Database\Seeder;
use App\MrbDisposition;

class DispositionMRBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Use is as','Scrap','Repair','Rework','RTS'];
        
                for ($i=0;$i<count($data);$i++){
                    $mrb_disp = new MrbDisposition();
                    $mrb_disp->description = $data[$i];
                    $mrb_disp->save();
    }
}
}

