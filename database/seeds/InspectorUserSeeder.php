<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserInspektor;
use App\Role;
use App\UnitInspectorCode;

class InspectorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		for($k=0 ; $k<8 ; $k++)
    	{
	        $rows = Excel::selectSheetsByIndex($k)->load('/public/seeder_file/inspector.xlsx', function($reader){
	           
	        })->get();
	        
	        $rowRules = [
	            'nama_personil' => 'required',
	            'nip' => 'required',
	            'no_reg_inspektor' => 'required',
	            'pekerjaan' => 'required',
	            'kompetensi' => 'required',
	        ];

	        $i= 0;
	        foreach($rows as $row)
	        {
	            
	            $validator = Validator::make($row->toArray(), $rowRules);
	            
	            if($validator->fails())
	            {
	               // dd($validator);
	                continue;
	            }

	            try{
	                $user = new User();
	                $user->name = $row['nama_personil'];
	                $user->nip = $row['nip'];
					
					$ui = UnitInspectorCode::select('id','division_id')->where('ui_code',$row['kode'])->first();
					$user->divisi_id = $ui->division_id;
					//$user->divisi_id = $divisi_id[$k];
	                $user->jabatan_id = 1; // masih belum fix
	                $user->password = bcrypt('rahasia');
					$user->save();
					
					$role = Role::find(3);
	                $user->attachRole($role);

					// $table->integer('inspector_group_id')->unsigned()->nullable();
          
	                $userInspektor = new UserInspektor();
	                $userInspektor->user_id = $user->id;
	                $userInspektor->inspector_number = $row['no_reg_inspektor'];
	                $userInspektor->pekerjaan = $row['pekerjaan'];
					$userInspektor->kompetensi = $row['kompetensi'];
					$userInspektor->inspector_group_id = $ui->id;
	                $userInspektor->save();
	            } 

	            catch(Exception $e){
	                //dd($e);
	                continue;
	            }
	            $i++;   
	        }
		}
		
		$gmRole = new Role();
        $gmRole->name = "gm";
        $gmRole->display_name = "General Manager";
		$gmRole->save();
		
        $user = new User();
        $user->name = "Arif Muhaimin";
        $user->nip = "999600007";
        $user->email = "arif.muhaimin@inka.co.id";
		$user->password = bcrypt('rahasia');
		
        $user->jabatan_id = 1;
        $user->divisi_id = 9;
		$user->save();
		
		$user->attachRole($gmRole);
    }
}
