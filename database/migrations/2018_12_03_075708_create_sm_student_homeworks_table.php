<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStudentHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_student_homeworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->length(11)->unsigned();
            $table->integer('subject_id')->length(11)->unsigned();
            $table->date('homework_date')->nullable();
            $table->date('submission_date')->nullable();
            $table->string('description',500)->nullable();
            $table->string('percentage',50)->nullable();
            $table->integer('evaluated_by')->length(11)->unsigned();
            $table->string('status',10)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

       //  Schema::table('sm_student_homeworks', function($table) {
       //      $table->foreign('student_id')->references('id')->on('sm_students');
       //      $table->foreign('subject_id')->references('id')->on('sm_subjects');
           
       // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_student_homeworks');
    }
}
