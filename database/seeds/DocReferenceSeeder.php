<?php

use Illuminate\Database\Seeder;
use App\DocReferenceDivision;

class DocReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doc_head = ['43','44','KA-45','DIB-45'];
        $doc_unit = ['87','140','86','146'];
        $doc_description = ['PO Rendal Jasa','PO Rendal Eksport Import','PO Rendal Material-LOG','PO Rendal Material-DIB'];

        foreach($doc_head as $key=>$head){
            // dd($key);
            $doc = new DocReferenceDivision();
            
            $doc->doc_number_head = $head;
            $doc->unit_id = $doc_unit[$key];
            $doc->description = $doc_description[$key];
            $doc->save();
        }

    }
}
