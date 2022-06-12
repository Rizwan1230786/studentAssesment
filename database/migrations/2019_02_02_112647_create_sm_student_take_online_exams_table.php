<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStudentTakeOnlineExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_student_take_online_exams', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('online_exam_id')->nullable();
            $table->tinyInteger('student_id')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1 = alreday submitted, 2 = got marks');
            $table->integer('total_marks')->nullable();
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
        Schema::dropIfExists('sm_student_take_online_exams');
    }
}
