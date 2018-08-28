<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPicRespNcrReg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ncr_registrations', function($table){
            $table->integer('id_pic_respon')->unsigned()->nullable();
            
            $table->foreign('id_pic_respon') ->references('id')->on('users')
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
        Schema::table('ncr_registrations', function($table){
            $table->dropColumn('id_pic_respon');
        });
    }
}
