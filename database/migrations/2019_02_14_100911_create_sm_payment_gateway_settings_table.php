<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmPaymentGatewaySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_payment_gateway_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gateway_name')->nullable();
            $table->string('paypal_username')->nullable();
            $table->string('paypal_password')->nullable();
            $table->string('paypal_signature')->nullable();
            $table->string('paypal_client_id')->nullable();
            $table->string('paypal_secret_id')->nullable();
            $table->string('paypal_mode')->nullable();
            $table->string('stripe_api_secret_key')->nullable();
            $table->string('stripe_publisher_key')->nullable();
            $table->string('pay_u_money_key')->nullable();
            $table->string('pay_u_money_salt')->nullable();
            $table->tinyInteger('active_status')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
        DB::table('sm_payment_gateway_settings')->insert([
            [
                'gateway_name' => 'Paypal',
                'paypal_username'=>'Rashed',
                'paypal_password'=>'123345',
                'paypal_client_id'=>'155',
                'paypal_secret_id'=>'33'
                
            ],
            [
                'gateway_name' => 'Stripe',
                'paypal_username'=>'Banlu',
                'paypal_password'=>'123454',
                'paypal_client_id'=>'66',
                'paypal_secret_id'=>'1234'
            ],
            [
                'gateway_name' => 'PayUMoney',
                'paypal_username'=>'Abhi',
                'paypal_password'=>'12344',
                'paypal_client_id'=>'44',
                'paypal_secret_id'=>'333'
                
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
        Schema::dropIfExists('sm_payment_gateway_settings');
    }
}
