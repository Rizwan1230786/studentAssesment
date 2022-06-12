<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmOnlineExamQuestionMuOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_online_exam_question_mu_options', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('online_exam_question_id')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('status')->nullable()->comment('0 unchecked 1 checked');
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
        Schema::dropIfExists('sm_online_exam_question_mu_options');
    }
}
