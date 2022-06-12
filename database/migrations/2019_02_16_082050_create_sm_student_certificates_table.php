<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStudentCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_student_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('header_left_text')->nullable();
            $table->date('date')->nullable();
            $table->text('body')->nullable();
            $table->string('footer_left_text')->nullable();
            $table->string('footer_center_text')->nullable();
            $table->string('footer_right_text')->nullable();
            $table->tinyInteger('student_photo')->default(1)->comment('1 = yes 0 no');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('sm_student_certificates');
    }
}
