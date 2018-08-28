<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLatlongColumnNcrRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ncr_registrations', function (Blueprint $table) {
            $table->decimal('long', 10, 7)->after('publish_date');
            $table->decimal('lat', 10, 7)->after('publish_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ncr_registrations', function($table) {
            $table->dropColumn('lat');
            $table->dropColumn('long');
        });
    }
}
