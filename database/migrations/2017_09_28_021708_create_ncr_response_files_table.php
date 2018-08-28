<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNcrResponseFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncr_response_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('response_id')->unsigned();
            $table->string('ncr_response_upload');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('response_id') ->references('id')->on('ncr_responses')
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
        Schema::dropIfExists('ncr_response_files');
    }
}
