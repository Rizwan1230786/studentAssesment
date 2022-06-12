<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmExamAttendanceChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_exam_attendance_children', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('exam_attendance_id')->nullable();
            $table->tinyInteger('student_id')->nullable();
            $table->string('attendance_type',2)->nullable()->comment('P = present A = Absent');
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
        Schema::dropIfExists('sm_exam_attendance_children');
    }
}
