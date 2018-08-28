<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNcrResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncr_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('ncr_id')->unsigned();
            $table->integer('disp_unit_id')->unsigned();
            $table->integer('mrb_id')->unsigned()->nullable();
            $table->longtext('problem_description');
            $table->longtext('corrective_act')->nullable();
            $table->date('corrective_est_date')->nullable();
            $table->longtext('preventive_act')->nullable();
            $table->date('preventive_est_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id') ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('ncr_id') ->references('id')->on('ncr_registrations')
                ->onUpdate('cascade')->onDelete('cascade');
            
            
            $table->foreign('disp_unit_id') ->references('id')->on('unit_dispositions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('mrb_id') ->references('id')->on('mrb_dispositions')
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
        Schema::dropIfExists('ncr_responses');
    }
}
