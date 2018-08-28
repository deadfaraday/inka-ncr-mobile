<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_problems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resp_id')->unsigned();
            $table->integer('problem_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('resp_id') ->references('id')->on('ncr_responses')
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
        Schema::dropIfExists('response_problems');
    }
}
