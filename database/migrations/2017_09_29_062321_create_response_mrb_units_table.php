<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseMrbUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_mrb_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('response_id')->unsigned();
            $table->integer('mrb_disp_id')->unsigned();
            $table->integer('division_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('response_id') ->references('id')->on('ncr_responses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('mrb_disp_id') ->references('id')->on('mrb_dispositions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('division_id') ->references('id')->on('divisions')
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
        Schema::dropIfExists('response_mrb_units');
    }
}
