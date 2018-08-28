<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitInspectorCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_inspector_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('division_id')->unsigned()->nullable();
            $table->integer('is_inspector')->default(0);
            $table->string('ui_code','10')->nullable();
            $table->string('ui_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
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
        Schema::dropIfExists('unit_inspector_codes');
    }
}
