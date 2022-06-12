<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',100)->nullable();
            $table->string('company_address',500)->nullable();
            $table->string('contact_person_name')->nullable();
            $table->integer('contact_person_mobile')->nullable();
            $table->string('contact_person_email',100)->nullable();
            $table->string('cotact_person_address',500)->nullable();
            $table->string('description',500)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('sm_suppliers');
    }
}
