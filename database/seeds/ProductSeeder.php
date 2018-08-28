<?php

use Illuminate\Database\Seeder;
use App\MasterProduct;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masuk = new MasterProduct();
        $masuk->product_description = 'Produk Masuk';
        $masuk->save();

        $proses = new MasterProduct();
        $proses->product_description = 'Produk Proses Finishing';
        $proses->save();

        
        $proses = new MasterProduct();
        $proses->product_description = 'Produk Proses Fabrikasi';
        $proses->save();

        $final = new MasterProduct();
        $final->product_description = 'Proses Final';
        $final->save();
    }
}
