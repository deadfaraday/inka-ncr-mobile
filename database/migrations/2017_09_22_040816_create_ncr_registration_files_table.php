<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNcrRegistrationFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncr_registration_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ncr_registration_id')->unsigned();
            $table->string('ncr_registration_upload')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ncr_registration_id')->references('id')->on('ncr_registrations')
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
        Schema::dropIfExists('ncr_registration_files');
    }
}
