<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;


class AddAuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Admin Role
        /*
        $auditorRole = new Role();
        $auditorRole->name = "auditor_mmlh";
        $auditorRole->display_name = "Auditor MMLH";
        $auditorRole->save();

        $user = new User();
        $user->name = "Auditor MMLH";
        $user->nip = "1234554321";
        $user->email = "agriie07@gmail.com";
        $user->password = bcrypt('rahasia');
        $user->jabatan_id = 1;
        $user->divisi_id = 1;
        $user->save();        
        $user->attachRole($auditorRole);
        */

        $auditorRole = Role::where('name','auditor_mmlh')->first();

        if(is_null($auditorRole)){
            $auditorRole = new Role();
            $auditorRole->name = "auditor_mmlh";
            $auditorRole->display_name = "Auditor MMLH";
            $auditorRole->save();
        }

        // $user = new User();
        // $user->name = "Sholih Farhat";
        // $user->nip = "999600027";
        // $user->email = "sholih.farhat@inka.co.id";
        // $user->password = bcrypt('999600027');
        // $user->jabatan_id = 1;
        // $user->divisi_id = 1;
        // $user->save();        
        // $user->attachRole($auditorRole);

        $user = new User();
        $user->name = 'Tulus Widodo';
        $user->nip = "998500031" ;
        $user->email = "tulus.widodo@inka.co.id";
        $user->password = bcrypt('998500031');
        $user->jabatan_id = 1;
        $user->divisi_id = 1;
        $user->save();        
        $user->attachRole($auditorRole);

    }
}
