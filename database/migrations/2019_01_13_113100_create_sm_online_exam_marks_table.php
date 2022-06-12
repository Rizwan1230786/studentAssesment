<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmOnlineExamMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_online_exam_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('exam_id')->nullable();
            $table->tinyInteger('subject_id')->nullable();
            $table->tinyInteger('student_id')->nullable();
            $table->integer('marks')->nullable();
            $table->integer('abs')->default(0);
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
        Schema::dropIfExists('sm_online_exam_marks');
    }
}
