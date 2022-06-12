<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmExamTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_exam_types', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('school_id')->default(1);
            $table->Integer('active_status')->default(1);
            $table->string('title',255);
            $table->string('created_by',50)->default(1);
            $table->string('updated_by',50)->default(1);
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
        Schema::dropIfExists('sm_exam_types');
    }
}
