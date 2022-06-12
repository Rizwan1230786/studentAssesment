<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmItemReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_item_receives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->date('receive_date')->nullable();
            $table->string('reference_no')->nullable();
            $table->integer('grand_total')->nullable();
            $table->integer('total_quantity')->nullable();
            $table->integer('total_paid')->nullable();
            $table->integer('total_due')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('paid_status')->nullable();
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
        Schema::dropIfExists('sm_item_receives');
    }
}
