<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInspektorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_inspektors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('inspector_number');
            $table->integer('inspector_group_id')->unsigned()->nullable();
            $table->string('pekerjaan');
            $table->string('kompetensi');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id') ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('inspector_group_id') ->references('id')->on('unit_inspector_codes')
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
        Schema::dropIfExists('user_inspektors');
    }
}
