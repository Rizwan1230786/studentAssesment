<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmItemIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_item_issues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->nullable()->unsigned();
            $table->integer('issue_to')->nullable()->unsigned();
            $table->integer('issue_by')->nullable()->unsigned();
            $table->integer('item_category_id')->nullable()->unsigned();
            $table->integer('item_id')->nullable()->unsigned();
            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('quantity')->nullable()->unsigned();
            $table->string('issue_status')->nullable();
            $table->string('note',500)->nullable();
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
        Schema::dropIfExists('sm_item_issues');
    }
}
