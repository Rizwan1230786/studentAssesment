<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmTemporaryMeritlists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_temporary_meritlists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merit_order')->nullable();
            $table->integer('exam_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('student_name',250)->nullable();
            $table->string('admission_no',250)->nullable();
            $table->string('subjects_string',250)->nullable();
            $table->string('marks_string',250)->nullable();
            $table->string('total_marks',250)->nullable();
            $table->string('average_mark',250)->nullable();
            $table->string('gpa_point',250)->nullable();
            $table->string('result',250)->nullable();
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
        Schema::dropIfExists('sm_temporary_meritlists');
    }
}
