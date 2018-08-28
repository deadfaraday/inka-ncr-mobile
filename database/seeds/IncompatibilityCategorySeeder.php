<?php

use Illuminate\Database\Seeder;
use App\IncompatibilityCategory;

class IncompatibilityCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $incompatibility_category = ['Minor','Mayor'];
        for ($i=0;$i<count($incompatibility_category);$i++){
            $inc_cat = new IncompatibilityCategory();
            $inc_cat->description = $incompatibility_category[$i];
            $inc_cat->save();

        }

    }
}
