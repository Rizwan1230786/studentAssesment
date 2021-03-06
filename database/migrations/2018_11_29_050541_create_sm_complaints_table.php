<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('complaint_by')->nullable();
            $table->tinyInteger('complaint_type')->nullable();
            $table->tinyInteger('complaint_source')->nullable();
            $table->string('phone')->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->string('action_taken')->nullable();
            $table->string('assigned')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('sm_complaints');
    }
}
