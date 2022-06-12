<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmAcademicYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_academic_years', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year', 30);
            $table->string('title', 30);
            $table->date('starting_date');
            $table->date('ending_date');
            $table->bigInteger('school_id')->nullable()->default(1);
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
        Schema::dropIfExists('sm_academic_years');
    }
}
