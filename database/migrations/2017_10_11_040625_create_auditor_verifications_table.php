<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditorVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditor_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reg_ncr_id')->unsigned();
            $table->integer('resp_ncr_id')->unsigned();
            $table->longtext('verification_description');
            $table->integer('ver_result_id')->unsigned();
            $table->integer('new_car_id')->unsigned()->nullable();
            $table->integer('auditor_id')->unsigned();
            $table->date('publish_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('reg_ncr_id')->references('id')->on('ncr_registrations')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('auditor_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('resp_ncr_id') ->references('id')->on('ncr_responses')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('ver_result_id') ->references('id')->on('verification_results')
                ->onUpdate('cascade')->onDelete('cascade');
            
            /*
            $table->foreign('new_car_id') ->references('id')->on('ncr_registrations')
                ->onUpdate('cascade')->onDelete('cascade');
                */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditor_verifications');
    }
}
