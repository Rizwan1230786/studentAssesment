<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject_name', 40);
            $table->string('subject_code', 40)->nullable();
            $table->enum('subject_type', ['T','P'])->comment = 'T=Theory, P=Practical';
            $table->bigInteger('school_id')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->default(1)->nullable();
            $table->string('updated_by')->default(1)->nullable();
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
        Schema::dropIfExists('sm_subjects');
    }
}
