<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DivisionSeeder::class); 
        $this->call(UserSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(IncompatibilityCategorySeeder::class);
        $this->call(ProductIdentitySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(DispositionInspectorSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DispositionMRBSeeder::class);
        $this->call(ProblemSourceSeeder::class);
        $this->call(UnitDispositionSeeder::class);
        $this->call(UnitInspectorCodeSeeder::class);
        $this->call(InspectorUserSeeder::class);
        $this->call(VerificationResultSeeder::class);
        $this->call(AddAuditorSeeder::class);
        $this->call(AdminRespSeeder::class);
    }
}
