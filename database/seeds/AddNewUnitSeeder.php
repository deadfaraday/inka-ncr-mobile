<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Division;
use App\User;
use App\vMasterPegawai;

class AddNewUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gmRole = Role::where('name','general_manager')->first();
        $smRole = Role::where('name','senior_manager')->first();
        $mRole = Role::where('name','manager')->first();
        $spvRole = Role::where('name','supervisor')->first();

        $rows = Excel::selectSheetsByIndex(0)->load('/public/seeder_file/new_unit.xlsx', function($reader){
            //options
        })->get();

        $rowRules = [
            'id' => 'required',
            'nama' => 'required',
            'parent' => 'required',
        ];


        $i= 0;
        $unit_changed =0;
        $user_baru = 0; 
        $user_changed = 0;

        foreach($rows as $row)
        {
            
            $validator = Validator::make($row->toArray(), $rowRules);
            
            if($validator->fails())
            {
               // dd($validator);
                continue;
            }

            try{
                $new_unit = Division::find($row['id']);

                if(!$new_unit)
                {
                    $new_unit = new Division();
                    // dd($row['nama']);
                    $new_unit->division_name = $row['nama'];
                    $new_unit->parent = $row['parent'];
                    
                    if(!is_null($row['kadiv'])){
                        $nip = number_format( $row['kadiv'], 0, '', '' );
                        $new_unit->kadiv_nip = $nip;
                        $new_unit->save();
                        /*  
                            1. cari dulu di user apa sudah ada nip tersebut
                            2. kalau ada , update jabatan nya 
                            3. kalau g ada, bikin user tersebut  
                        */
                        $user_exist = User::where('nip',$row['kadiv'])->first();
                        
                        if(!is_null($user_exist)){
                            $user_exist->jabatan_id = $row['jabatan'];
                            $user_exist->divisi_id = $row['id'];
                            $user_exist->save();

                            if($row['jabatan'] == '1'){
                                if(!$user_exist->hasRole($gmRole))
                                    continue;    
                                else
                                    $user_exist->attachRole($gmRole);
                            }elseif($row['jabatan']== '2')
                            {
                                if(!$user_exist->hasRole($smRole))
                                    continue;    
                                else
                                    $user_exist->attachRole($smRole);
                            }elseif($row['jabatan']== '3')
                            {
                                if(!$user_exist->hasRole($mRole))
                                    continue;    
                                else
                                    $user_exist->attachRole($mRole);
                            }
                            elseif($row['jabatan']== '4')
                            {
                                if(!$user_exist->hasRole($spvRole))
                                    continue;    
                                else
                                    $user_exist->attachRole($spvRole);   
                            }
                            $user_changed++;

                        }elseif(is_null($user_exist)){
                            $new_user = new User();
                        
                            // data user dari keshc 
                            $ref_user = vMasterPegawai::where('REGNO',$nip)->first();

                            $new_user->nip = $nip;
                            $new_user->name = trim($ref_user->NAME);
                            
                            if(!is_null($row['jabatan']))
                                $new_user->jabatan_id = $row['jabatan'];
                            
                            $new_user->divisi_id = $row['id'];
                            $new_user->email = trim($ref_user->EMAIL);
                            $new_user->password = bcrypt($nip);
                            $new_user->save();

                            if($row['jabatan'] == '1'){
                                $new_user->attachRole($gmRole);
                            }elseif($row['jabatan']== '2')
                            {
                                $new_user->attachRole($smRole);
                            }elseif($row['jabatan']== '3')
                            {
                                $new_user->attachRole($mRole);
                            }
                            elseif($row['jabatan']== '4')
                            {
                                $new_user->attachRole($spvRole);   
                            }

                            $user_baru++;
                        }
                        $new_unit->save();
                    }
                }
                
                
                
            } 

            catch(Exception $e){
                dd($e,$row['id']);
                continue;
            }
            $i++;   
        }

        dd($unit_changed,$user_changed,$user_baru);
    }
}
