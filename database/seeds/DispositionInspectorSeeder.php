<?php

use Illuminate\Database\Seeder;
use App\DispositionInspector;

class DispositionInspectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $internal = new DispositionInspector();
        $internal->disposisi_description = 'Kembali ke Pemasok Internal';
        $internal->save();

        $eksternal = new DispositionInspector();
        $eksternal->disposisi_description = 'Kembali ke Pemasok Eksternal';
        $eksternal->save();
    }
}
