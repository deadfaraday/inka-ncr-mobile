<?php

use Illuminate\Database\Seeder;
use App\UnitDisposition;
use App\IncompatibilityCategory;

class UnitDispositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Repair','Reject','MRB'];
        for ($i=0;$i<count($data);$i++){
            $unit_disp = new UnitDisposition();
            $unit_disp->description = $data[$i];

            if($data[$i]=='MRB'){
                $category_mayor = IncompatibilityCategory::select('id')->where('description','Mayor')->first();
                $unit_disp->problem_category_id = $category_mayor->id;
            } else{
                $category_minor = IncompatibilityCategory::select('id')->where('description','Minor')->first();
                $unit_disp->problem_category_id = $category_minor->id;
            }
            $unit_disp->save();
        }   
    }

}