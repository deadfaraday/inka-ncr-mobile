<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocreferenceToNcrReg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ncr_registrations', function($table) {
            $table->integer('doc_reference_id')->unsigned()->nullable();
            $table->string('doc_reference')->nullable();
            
            $table->foreign('doc_reference_id') ->references('id')
                ->on('doc_reference_divisions')
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
        Schema::table('ncr_registrations', function($table) {
            $table->dropColumn('doc_reference_id')->nullable();
        });
    }
}
