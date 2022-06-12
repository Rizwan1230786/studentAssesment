<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStudentTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_student_timelines', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('staff_student_id');
            $table->string('title')->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->string('type')->nullable()->comment('stu=student,stf=staff');
            $table->tinyInteger('visible_to_student')->default(0)->comment('0 = no, 1 = yes');
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
        Schema::dropIfExists('sm_student_timelines');
    }
}
