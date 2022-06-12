<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStudentTakeOnlineExamQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_student_take_online_exam_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('take_online_exam_id')->nullable();
            $table->tinyInteger('question_bank_id')->nullable();
            $table->string('trueFalse', 1)->nullable()->comment('F = false, T = true ');
            $table->text('suitable_words')->nullable();
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
        Schema::dropIfExists('sm_student_take_online_exam_questions');
    }
}
