<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->default(1)->nullable();
            $table->integer('class_id')->nullable()->unsigned();
            $table->integer('section_id')->nullable()->unsigned();
            $table->integer('session_id')->nullable()->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('parent_id')->nullable()->unsigned(); 
            $table->integer('admission_no')->nullable();
            $table->integer('roll_no')->nullable();
            $table->string('first_name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('full_name',200)->nullable();
            $table->integer('gender_id')->nullable()->unsigned();
            $table->date('date_of_birth')->nullable();
            $table->integer('student_category_id')->nullable();
            $table->string('caste',100)->nullable();
            $table->string('email',50)->nullable();
            $table->string('mobile',50)->nullable();
            $table->date('admission_date')->nullable();
            $table->string('student_photo')->nullable();
            $table->integer('bloodgroup_id')->nullable()->unsigned();
            $table->integer('religion_id')->nullable()->unsigned();
            $table->string('height',50)->nullable();
            $table->string('weight',50)->nullable();
            $table->string('current_address',500)->nullable();
            $table->string('permanent_address',500)->nullable();
            $table->integer('route_list_id')->nullable()->unsigned();
            $table->integer('dormitory_id')->nullable()->unsigned();
            $table->integer('vechile_id')->nullable()->unsigned();
            $table->integer('room_id')->nullable()->unsigned();
            $table->string('driver_id',100)->nullable(); 
            $table->string('national_id_no',50)->nullable();
            $table->string('local_id_no',50)->nullable();
            $table->string('bank_account_no',50)->nullable();
            $table->string('bank_name',50)->nullable();
            $table->string('previous_school_details',500)->nullable();
            $table->string('aditional_notes',500)->nullable();
            $table->string('document_title_1',100)->nullable();
            $table->string('document_file_1',100)->nullable();
            $table->string('document_title_2',100)->nullable();
            $table->string('document_file_2',100)->nullable();
            $table->string('document_title_3',100)->nullable();
            $table->string('document_file_3',100)->nullable();
            $table->string('document_title_4',100)->nullable();
            $table->string('document_file_4',100)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
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
        Schema::dropIfExists('sm_students');
    }
}
