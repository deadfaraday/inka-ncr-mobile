<?php

use Illuminate\Database\Seeder;
use App\ProductIdentity;

class ProductIdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $no_part = new ProductIdentity();
        $no_part->identity_description = 'No Part';
        $no_part->save();

        $drawing = new ProductIdentity();
        $drawing->identity_description = 'Drawing';
        $drawing->save();

        $pi = new ProductIdentity();
        $pi->identity_description = 'PI';
        $pi->save();

        $nama_product = new ProductIdentity();
        $nama_product->identity_description = 'Nama Product';
        $nama_product->save();

        $kontrak = new ProductIdentity();
        $kontrak->identity_description = 'Kontrak';
        $kontrak->save();

        $tatc = new ProductIdentity();
        $tatc->identity_description = 'Tatc';
        $tatc->save();
    }
}
