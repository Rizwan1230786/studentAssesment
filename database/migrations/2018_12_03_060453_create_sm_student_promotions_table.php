<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStudentPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_student_promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('previous_class_id')->unsigned()->nullable();
            $table->integer('current_class_id')->unsigned()->nullable();
            $table->integer('previous_session_id')->unsigned()->nullable();
            $table->integer('current_session_id')->unsigned()->nullable();
            $table->string('result_status', 10)->nullable();
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
            $table->timestamps();
        });

       //  Schema::table('sm_student_promotions', function($table) {
       //     $table->foreign('student_id')->references('id')->on('sm_students');
           
       // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_student_promotions');
    }
}
