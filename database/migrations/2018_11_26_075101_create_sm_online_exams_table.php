<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmOnlineExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_online_exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->tinyInteger('class_id')->nullable();
            $table->tinyInteger('section_id')->nullable();
            $table->tinyInteger('subject_id')->nullable();
            $table->date('date')->nullable()->nullable();
            $table->string("start_time", 50)->nullable();
            $table->string("end_time", 50)->nullable();
            $table->string('end_date_time')->nullable();
            $table->integer("percentage")->nullable();
            $table->text("instruction")->nullable();
            $table->tinyInteger("status")->nullable()->comment('0 = Pending 1 Published');
            $table->bigInteger('school_id')->nullable();
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
        Schema::dropIfExists('sm_online_exams');
    }
}
