<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmOnlineExamQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_online_exam_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('online_exam_id')->nullable();
            $table->string('type', 1)->nullable();
            $table->integer('mark')->nullable();
            $table->text('title')->nullable();
            $table->string('trueFalse', 1)->nullable()->comment('F = false, T = true ');
            $table->text('suitable_words')->nullable();
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
        Schema::dropIfExists('sm_online_exam_questions');
    }
}
