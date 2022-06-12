<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmFeesAssignDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_fees_assign_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('fees_discount_id');
            $table->tinyInteger('student_id');
            $table->tinyInteger('school_id')->default(1);
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
        Schema::dropIfExists('sm_fees_assign_discounts');
    }
}
