<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Admin Role
        $suRole = new Role();
        $suRole->name = "superuser";
        $suRole->display_name = "Super User";
        $suRole->save();

        // admin role 
        $adminRole = new Role();
        $adminRole->name = "administrator";
        $adminRole->display_name = "Admin";
        $adminRole->save();

        // inspektor role 
        $inspektorRole = new Role();
        $inspektorRole->name = "inspektor";
        $inspektorRole->display_name = "Inspektor";
        $inspektorRole->save();

        // guest role 
        $guestRole = new Role();
        $guestRole->name = "guest";
        $guestRole->display_name = "Guest";
        $guestRole->save();

        $user = new User();
        $user->name = "Agri Kridanto";
        $user->nip = "991700051";
        $user->email = "agri.kridanto@inka.co.id";
        $user->password = bcrypt('rahasia');
        $user->jabatan_id = 1;
        $user->divisi_id = 1;
        $user->save();        
        $user->attachRole($adminRole);

        $user = new User();
        $user->name = "Admin";
        $user->nip = "771600003";
        $user->email = "admin@inka.co.id";
        $user->password = bcrypt('rahasia');
        $user->jabatan_id = 1;
        $user->divisi_id = 1;
        $user->save();
        
        $user->attachRole($adminRole);

        $user = new User();
        $user->name = "Inspektor";
        $user->nip = "661700015";
        $user->email = "inspektor@inka.co.id";
        $user->password = bcrypt('rahasia');
        $user->jabatan_id = 1;
        $user->divisi_id = 1;
        $user->save();
        
        $user->attachRole($inspektorRole);

        $user = new User();
        $user->name = "Guest";
        $user->nip = "123456789";
        $user->email = "guest@inka.co.id";
        $user->password = bcrypt('rahasia');
        $user->jabatan_id = 1;
        $user->divisi_id = 1;
        $user->save();
        
        $user->attachRole($guestRole);
    }
}
