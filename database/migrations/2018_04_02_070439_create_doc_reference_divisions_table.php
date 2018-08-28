<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocReferenceDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
            Digunakan untuk menentukan unit tujuan (yang di ncr) berdasarkan 
            kode dokumen yang diberikan
        */
        Schema::create('doc_reference_divisions', function (Blueprint $table) {
            $table->increments('id');
            // 2 DIGIT AWAL PENENTU TUJUAN,EX po : 43,44,45
            $table->string('doc_number_head');
            $table->integer('unit_id')->unsigned();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('unit_id') ->references('id')->on('divisions')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_reference_divisions');
    }
}
