<?php

use Illuminate\Database\Seeder;
use App\MasterProject;
use Illuminate\Support\Collection;

class ProjectUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = Excel::selectSheetsByIndex(0)->load('/public/seeder_file/700_project_update.xlsx', function($reader){
        })->get();

        $rowRules = [
            'project_code' => 'required',
            'project_description' => 'required',
        ];
        $imported = 0;
        foreach($rows as $row)
        {
            
            $validator = Validator::make($row->toArray(), $rowRules);
            
            if($validator->fails())
            {
                dd('error');
                continue;
            }

            try{
                // is exist ?
                $is_exist = MasterProject::where('project_code',$row['project_code'])->first();

                if(!$is_exist){
                    $project = MasterProject::create([
                        'project_code' => $row['project_code'], 
                        'project_description' => $row['project_description'],
                    ]);
                    $imported++;
                }

            } 

            catch(Exception $e){
                dd($e);
                continue;
            } 
        }
        dd($imported);
    }
}
