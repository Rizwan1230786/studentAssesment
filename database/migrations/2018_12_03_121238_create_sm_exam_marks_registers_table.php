<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmExamMarksRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_exam_marks_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exam_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->string('obtained_marks',50)->nullable();
            $table->date('exam_date')->nullable();
            $table->string('comments',500)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('school_id')->nullable()->default(1);
            $table->timestamps();
        });

       //  Schema::table('sm_exam_marks_registers', function($table) {
       //     $table->foreign('exam_id')->references('id')->on('sm_exams');
       //     $table->foreign('student_id')->references('id')->on('sm_students');
       //     $table->foreign('subject_id')->references('id')->on('sm_subjects');
           
       // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_exam_marks_registers');
    }
}
