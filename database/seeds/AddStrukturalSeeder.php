<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class AddStrukturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $struktural_role = new Role();
        $struktural_role->name = 'struktural';
        $struktural_role->display_name = 'Jabatan Struktural Non GM';
        $struktural_role->save();


        $list_nip = ['991100066','999200037','999800003',
        '991000015','999200038','991100024','991000007'];

        foreach($list_nip as $nip){
            $struktural_role = Role::where('name','struktural')->first();
            $user = User::where('nip', $nip)->first();
            
            if(!is_null($struktural_role))
                $user->attachRole($struktural_role);
        }

    }
}
