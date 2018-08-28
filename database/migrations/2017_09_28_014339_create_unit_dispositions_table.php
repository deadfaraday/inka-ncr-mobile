<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitDispositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_dispositions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('problem_category_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('problem_category_id') ->references('id')->on('incompatibility_categories')
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
        Schema::dropIfExists('unit_dispositions');
    }
}
