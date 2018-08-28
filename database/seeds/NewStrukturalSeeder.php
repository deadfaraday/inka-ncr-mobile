<?php

use Illuminate\Database\Seeder;
use App\Role;

class NewStrukturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // manager role 
        $mRole = new Role();
        $mRole->name = "manager";
        $mRole->display_name = "Manager";
        $mRole->save();

        // manager role 
        $smRole = new Role();
        $smRole->name = "senior_manager";
        $smRole->display_name = "Senior Manager";
        $smRole->save();

        // supervisor role 
        $spvRole = new Role();
        $spvRole->name = 'supervisor';
        $spvRole->display_name = "Supervisor";
        $spvRole->save();
    }
}
