<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmExamScheduleSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_exam_schedule_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('exam_schedule_id')->nullable();
            $table->tinyInteger('subject_id')->nullable();
            $table->date('date')->nullable();
            $table->string('start_time', 50)->nullable();
            $table->string('end_time', 50)->nullable();
            $table->string('room', 20)->nullable();
            $table->integer('full_mark')->nullable();
            $table->integer('pass_mark')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('sm_exam_schedule_subjects');
    }
}
