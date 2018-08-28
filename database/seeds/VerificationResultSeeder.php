<?php

use Illuminate\Database\Seeder;
use App\VerificationResult;

class VerificationResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $results = ['Efektif','Tidak Efektif'];

        foreach ($results as $result){
            $ver_result = new VerificationResult();
            $ver_result->description = $result;
            $ver_result->save();
        }
    }
}
