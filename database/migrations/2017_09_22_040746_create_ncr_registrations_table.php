<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateNcrRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncr_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_reg_ncr')->unique();
            $table->integer('user_id')->unsigned();
            $table->string('process_name');
            $table->string('reference_inspection');
            //edit for new form 
            $table->string('person_in_charge')->nullable();
            $table->integer('incompatibility_category_id')->unsigned();
            
            $table->longtext('description_incompatibility',1000000);
            $table->integer('product_identity_id')->unsigned();
            $table->integer('master_project_id')->unsigned();
            $table->integer('division_id')->unsigned();
            $table->string('vendor_name')->nullable();
            $table->integer('master_product_id')->unsigned();
            $table->integer('disposition_inspector_id')->unsigned();
            $table->integer('ui_code_id')->unsigned();
            $table->integer('is_response')->default(0);
            $table->integer('is_ver_inspector')->default(0);
            $table->integer('is_ver_auditor')->default(0);
            $table->date('publish_date')->nullable();
            $table->date('completion_target')->nullable();
            $table->integer('is_cancel')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id') ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_identity_id') ->references('id')->on('product_identities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('master_project_id') ->references('id')->on('master_projects')
                ->onUpdate('cascade')->onDelete('cascade');
            //foreign_key diganti dengan unit id 
            $table->foreign('division_id') ->references('id')->on('divisions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('incompatibility_category_id') ->references('id')->on('incompatibility_categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('master_product_id') ->references('id')->on('master_products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('disposition_inspector_id') ->references('id')->on('disposition_inspectors')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ui_code_id') ->references('id')->on('unit_inspector_codes')
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
        Schema::dropIfExists('ncr_registrations');
    }
}
