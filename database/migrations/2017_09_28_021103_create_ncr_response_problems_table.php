<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNcrResponseProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncr_response_problems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('response_id')->unsigned();
            $table->integer('problem_id')->unsigned();           
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('response_id') ->references('id')->on('ncr_responses')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('problem_id') ->references('id')->on('problem_sources')
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
        Schema::dropIfExists('ncr_response_problems');
    }
}
