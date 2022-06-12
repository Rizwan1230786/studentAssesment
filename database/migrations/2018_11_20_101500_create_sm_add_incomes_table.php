<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmAddIncome;
class CreateSmAddIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_add_incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->tinyInteger('income_head_id')->nullable();
            $table->tinyInteger('account_id')->nullable();
            $table->tinyInteger('payment_method_id')->nullable();
            $table->date('date')->nullable();
            $table->integer('amount')->nullable();
            $table->string('file')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('school_id')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });



        $store = new SmAddIncome();
        $store->name                =           'Donation for Boys football match';
        $store->income_head_id     =           1;
        $store->payment_method_id   =           1;
        $store->date                =           '2019-05-05';
        $store->amount              =           1200; 
        $store->save();



        $store = new SmAddIncome();
        $store->name                =           'Product Sales';
        $store->income_head_id     =           3;
        $store->payment_method_id   =           1;
        $store->date                =           '2019-05-05';
        $store->amount              =           15000; 
        $store->save(); 


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_add_incomes');
    }
}
