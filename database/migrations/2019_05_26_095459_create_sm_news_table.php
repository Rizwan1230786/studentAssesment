<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Faker\Factory as Faker;
class CreateSmNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('news_title');
            $table->integer('view_count')->nullable();
            $table->integer('active_status')->nullable();
            $table->string('image')->nullable();
            $table->string('image_thumb')->nullable();
            $table->text('news_body')->nullable();
            $table->date('publish_date')->nullable();
            $table->string('order')->nullable();
            $table->integer('category_id')->nullable();
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
        Schema::dropIfExists('sm_news');
    }
}
