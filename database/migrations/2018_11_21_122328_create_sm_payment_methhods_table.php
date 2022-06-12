<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmPaymentMethhodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_payment_methhods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('method', 30);
            $table->string('type')->nullable();
            $table->bigInteger('school_id')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
        DB::table('sm_payment_methhods')->insert([
            [
                'method' => 'Cash',
                'type' => 'System'
            ],
            [
                'method' => 'Cheque',
                'type' => 'System'
            ],
            [
                'method' => 'Bank',
                'type' => 'System'
            ],
            [
                'method' => 'Paypal',
                'type' => 'System'
            ],
            [
                'method' => 'Stripe',
                'type' => 'System'
            ]
            

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_payment_methhods');
    }
}
