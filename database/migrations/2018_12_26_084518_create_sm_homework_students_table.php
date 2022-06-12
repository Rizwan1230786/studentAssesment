<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmHomeworkStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_homework_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('homework_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->string('marks')->length(50)->nullable();
            $table->string('teacher_comments')->length(20)->nullable();
            $table->string('complete_status')->length(10)->nullable();
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
        Schema::dropIfExists('sm_homework_students');
    }
}
