<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmSendMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_send_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message_title',100)->nullable();
            $table->string('message_des',500)->nullable();
            $table->date('notice_date')->nullable();
            $table->date('publish_on')->nullable();
            $table->string('message_to',100)->nullable()->comment('message sent to these roles');
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
        Schema::dropIfExists('sm_send_messages');
    }
}
