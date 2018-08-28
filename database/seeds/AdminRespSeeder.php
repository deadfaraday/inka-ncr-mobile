<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class AdminRespSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $picRole = new Role();
        $picRole->name = "admin_pic_response";
        $picRole->display_name = "Admin_PIC";
        $picRole->save();
        
        $logRole = new Role();
        $logRole->name = "admin_logistik";
        $logRole->display_name = "Admin_Logistik";
        $logRole->save();

        $fabRole = new Role();
        $fabRole->name = "admin_fabrikasi";
        $fabRole->display_name = "Admin_Fabrikasi";
        $fabRole->save();

        $finRole = new Role();
        $finRole->name = "admin_finishing";
        $finRole->display_name = "Admin_Logistik";
        $finRole->save();

        $logUser = new User();
        $logUser->name = "Admin Logistik";
        $logUser->nip = "admin_logistik";
        $logUser->email = "admin.logistik@inka.co.id";
        $logUser->password = bcrypt('rahasia');
        $logUser->jabatan_id = 1;
        $logUser->divisi_id = 1;
        $logUser->save();
        $logUser->attachRole($logRole);
        $logUser->attachRole($picRole);

        $fabUser = new User();
        $fabUser->name = "Admin Fabrikasi";
        $fabUser->nip = "admin_fabrikasi";
        $fabUser->email = "admin.fabrikasi@inka.co.id";
        $fabUser->password = bcrypt('rahasia');
        $fabUser->jabatan_id = 1;
        $fabUser->divisi_id = 1;
        $fabUser->save();
        $fabUser->attachRole($fabRole);
        $fabUser->attachRole($picRole);

        $finUser = new User();
        $finUser->name = "Admin Finishing";
        $finUser->nip = "admin_finishing";
        $finUser->email = "admin.finishing@inka.co.id";
        $finUser->password = bcrypt('rahasia');
        $finUser->jabatan_id = 1;
        $finUser->divisi_id = 1;
        $finUser->save();
        $finUser->attachRole($finRole);
        $finUser->attachRole($picRole);
    }
}
