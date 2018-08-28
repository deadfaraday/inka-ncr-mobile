<?php

use Illuminate\Database\Seeder;
use App\MasterProject;

class UpdateProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storage_path = Storage::disk('sap')->getDriver()->getAdapter()->getPathPrefix();
        $filename = '700_project_update.xlsx';
        $projects = Storage::disk('sap')->exists($filename);
    
        // dd($projects);

        if($projects)
        {
            $path = $storage_path .$filename;
            $rows = Excel::selectSheetsByIndex(0)->load($path, function($reader){
                //options
            })->get();
            
        }   

        $rowRules = [
            'project' => 'required',
            'description' => 'required',
            
        ];

        $i= 0;
        $imported = 0;

        foreach($rows as $row)
        {
            
            $validator = Validator::make($row->toArray(), $rowRules);
            
            if($validator->fails())
            {
               // dd($validator);
                continue;
            }

            try{
                $exist = MasterProject::where('project_code',$row['project'])->first();

                if(!$exist){
                    $project = new MasterProject();
                    $project->project_code = $row['project'];
                    $project->project_description = $row['description'];
                    $project->save();
                    $imported++;
                }       
            } 

            catch(Exception $e){
                 //ada yg sn nya double dd()
                continue;
            }
            $i++;   
        }
        
        dd($imported,$i);
    }
}
