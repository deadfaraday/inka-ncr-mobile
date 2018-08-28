<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('nip',15)->unique();
            $table->string('email',100)->unique()->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->integer('jabatan_id')->unsigned();
            $table->integer('divisi_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('divisi_id') ->references('id')->on('divisions')
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
        Schema::dropIfExists('users');
    }
}
