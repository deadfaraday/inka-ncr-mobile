<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectorVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspector_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reg_id')->unsigned();
            $table->integer('resp_id')->unsigned();
            $table->longtext('verification_description');
            $table->integer('verification_result_id')->unsigned();
            $table->integer('new_ncr_id')->unsigned()->nullable();
            $table->date('publish_date')->nullable();

            $table->foreign('reg_id') ->references('id')->on('ncr_registrations')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('resp_id') ->references('id')->on('ncr_responses')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('verification_result_id') ->references('id')->on('verification_results')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('new_ncr_id') ->references('id')->on('ncr_registrations')
                ->onUpdate('cascade')->onDelete('cascade');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspector_verifications');
    }
}
