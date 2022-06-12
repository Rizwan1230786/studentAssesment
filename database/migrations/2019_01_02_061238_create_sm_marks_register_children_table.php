<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmMarksRegisterChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_marks_register_children', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('marks_register_id')->nullable();
            $table->tinyInteger('subject_id')->nullable();
            $table->integer('marks')->nullable();
 
            $table->integer('abs')->default(0)->comment('1 for absent, 0 for present');
 
            $table->float('gpa_point')->nullable();
            $table->string('gpa_grade',55)->nullable();
 
 
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
        Schema::dropIfExists('sm_marks_register_children');
    }
}
