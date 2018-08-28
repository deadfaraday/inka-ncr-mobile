<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class AddNewGmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $gmRole = new Role();
        // $gmRole->name = "gm";
        // $gmRole->display_name = "General Manager";
        // $gmRole->save();
        
        $gmRole = Role::where('name','gm')->first();
		
        $user = new User();
        $user->name = "Suwun Setyanto";
        $user->nip = "999900124";
        $user->email = "suwun.setyanto@inka.co.id";
		$user->password = bcrypt('999900124');
		
        $user->jabatan_id = 1;
        $user->divisi_id = 9;
		$user->save();
		
		$user->attachRole($gmRole);
    }
}
