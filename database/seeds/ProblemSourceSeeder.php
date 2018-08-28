<?php

use Illuminate\Database\Seeder;
use App\ProblemSource;

class ProblemSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Personil','Metode','Material','Mesin/Tool','Lain-Lain'];

        for ($i=0;$i<count($data);$i++){
            $problem_source = new ProblemSource();
            $problem_source->description = $data[$i];
            $problem_source->save();
        }
    }
}
