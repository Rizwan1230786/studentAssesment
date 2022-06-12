<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_email_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_engine_type')->nullable();
            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('smtp_server')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_security')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
        DB::table('sm_email_settings')->insert([
            [
                'email_engine_type' => 'smtp',
                'from_name'=>'demo_name',
                'from_email'=>'demo@email.com',
                'smtp_username'=>'spn5@spondonit.com',
                'smtp_password'=>'Dhaka@5577',
                'smtp_server'=>'smtp.mailtrap.io',
                'smtp_port'=>'2525',
                'smtp_security'=>'',
                'active_status'=>'1',
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
        Schema::dropIfExists('sm_email_settings');
    }
}
