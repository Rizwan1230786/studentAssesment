<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmFeesPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_fees_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('student_id')->nullable();
            $table->tinyInteger('fees_type_id')->nullable();
            $table->tinyInteger('fees_discount_id')->nullable();
            $table->tinyInteger('discount_month')->nullable();
            $table->double('discount_amount', 8, 2)->nullable();
            $table->double('fine', 8, 2)->nullable();
            $table->double('amount', 8, 2)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_mode', 2)->comment('C= Cash, Cq=Cheque, D=DD');
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
        Schema::dropIfExists('sm_fees_payments');
    }
}
