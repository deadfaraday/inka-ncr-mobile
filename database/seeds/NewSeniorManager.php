<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Division;

class NewSeniorManager extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$smRole = Role::where('name','senior_manager')->first();
    	$m_division = Division::where('division_name','DEP. PENGENDALIAN KUALITAS INPROCESS')->first();

    	$user = new User();
        $user->name = "ANDI ARIF ISYANTO";
        $user->nip = "990900003";
        $user->email = "andi.arif@inka.co.id";
        $user->password = bcrypt('990900003');
        $user->jabatan_id = 2;
        $user->divisi_id = $m_division->id;
        $user->save();
        
        $user->attachRole($smRole);

        $m_division->kadiv_nip = $user->nip;
        $m_division->save();

        $struktural_role = Role::where('name','struktural')->first();

        $struktural_user = User::where('jabatan_id',2)->get();
        foreach($struktural_user as $user)
        {
        	$user->attachRole($struktural_role);
        }
    }
}
