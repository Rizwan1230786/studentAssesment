<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_leave_types', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('type')->nullable();
            $table->integer('total_days')->nullable()->unsigned();
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
        Schema::dropIfExists('sm_leave_types');
    }
}
