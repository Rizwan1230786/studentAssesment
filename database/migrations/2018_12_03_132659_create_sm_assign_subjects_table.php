<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmAssignSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_assign_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->nullable()->default(1);
            $table->integer('class_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->integer('subject_id')->nullable();
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
        Schema::dropIfExists('sm_assign_subjects');
    }
}
