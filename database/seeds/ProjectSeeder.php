<?php

use Illuminate\Database\Seeder;
use App\MasterProject;
use Illuminate\Support\Collection;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = Excel::selectSheetsByIndex(0)->load('/public/seeder_file/projects.xlsx', function($reader){
        })->get();

        $rowRules = [
            'project_code' => 'required',
            'project_description' => 'required',
        ];

        foreach($rows as $row)
        {
            
            $validator = Validator::make($row->toArray(), $rowRules);
            
            if($validator->fails())
            {
                dd('error');
                continue;
            }

            try{
                $project = MasterProject::create([
                    'project_code' => $row['project_code'], 
                    'project_description' => $row['project_description'],
                ]);
                 
            } 

            catch(Exception $e){
                dd($e);
                continue;
            } 
        }
    }
}
