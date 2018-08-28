<?php

use Illuminate\Database\Seeder;
use App\User;
use App\vMasterPegawai;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email_filled = 0;
        // seeder untuk mengisi email karyawan termasuk inspektor dan user lain
        $users = User::whereNotNull('nip')->whereNull('email')->get();

        foreach ($users as $user){
            // data user dari keshc 
            $ref_user = vMasterPegawai::where('REGNO',$user->nip)->first();
            
            if(!is_null($ref_user->EMAIL)){
                $user->email = $ref_user->EMAIL;
                $email_filled++;
            }
                 
            $user->save();
        }

        dd($email_filled);
        
    }
}
