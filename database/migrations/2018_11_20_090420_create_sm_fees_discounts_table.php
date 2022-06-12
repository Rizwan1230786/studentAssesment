<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmFeesDiscount;
class CreateSmFeesDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_fees_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->nullable();
            $table->string('code', 30)->nullable();
            $table->enum('type', ['once', 'year'])->nullable()->comment('once for one time, year for all months');
            $table->double('amount', 8, 2)->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('school_id')->nullable()->default(1);
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable()->default(1);
            $table->string('updated_by')->nullable()->default(1);
            $table->timestamps();
        });

        $store = new SmFeesDiscount();
        $store->name = 'Merit Scholarship';
        $store->code = 'SS-01';
        $store->type = 'year';
        $store->amount = 1000;
        $store->description = 'Merit Scholarship';
        $store->save();

        
        $store = new SmFeesDiscount();
        $store->name = 'Siblings Scholarship';
        $store->code = 'SB-01';
        $store->type = 'once';
        $store->amount = 1000;
        $store->description = 'Siblings Scholarship';
        $store->save();

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_fees_discounts');
    }
}
