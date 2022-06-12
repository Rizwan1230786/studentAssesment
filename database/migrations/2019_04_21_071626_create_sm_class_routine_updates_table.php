<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmClassRoutineUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_class_routine_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('school_id')->default(1)->nullable();
            $table->tinyInteger('class_id')->nullable();
            $table->tinyInteger('section_id')->nullable();
            $table->tinyInteger('subject_id')->nullable();
            $table->tinyInteger('teacher_id')->nullable();
            $table->tinyInteger('room_id')->nullable();
            $table->tinyInteger('class_period_id')->nullable();
            $table->tinyInteger('day')->nullable()->comment('1=sat,2=sun,7=fri');
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
        Schema::dropIfExists('sm_class_routine_updates');
    }
}
