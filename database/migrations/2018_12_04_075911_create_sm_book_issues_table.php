<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmBookIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_book_issues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->nullable()->unsigned();
            $table->integer('book_id')->nullable()->unsigned();
            $table->integer('quantity')->nullable();
            $table->date('given_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('issue_status')->nullable();
            $table->string('note',500)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

       //  Schema::table('sm_book_issues', function($table) {
       //     $table->foreign('member_id')->references('id')->on('sm_library_members');
       //     $table->foreign('book_id')->references('id')->on('sm_books');
           
       // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_book_issues');
    }
}
