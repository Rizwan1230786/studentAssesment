<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_parents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->length(11)->unsigned();
            $table->string('fathers_name',100)->nullable();
            $table->string('fathers_mobile',100)->nullable();
            $table->string('fathers_occupation',100)->nullable();
            $table->string('fathers_photo',100)->nullable();
            $table->string('mothers_name',100)->nullable();
            $table->string('mothers_mobile',100)->nullable();
            $table->string('mothers_occupation',100)->nullable();
            $table->string('mothers_photo',100)->nullable();
            $table->string('relation',10)->nullable();
            $table->string('guardians_name',100)->nullable();
            $table->string('guardians_mobile',50)->nullable();
            $table->string('guardians_email',50)->nullable();
            $table->string('guardians_occupation',100)->nullable();
            $table->string('guardians_relation',30)->nullable();
            $table->string('guardians_photo',100)->nullable();
            $table->string('guardians_address',100)->nullable();
            $table->integer('is_guardian')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();
        });

       //   Schema::table('sm_parents', function($table) {
       //      $table->foreign('user_id')->references('id')->on('users');
       // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_parents');
    }
}
