<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->nullable()->default(1);
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('role_id')->nullable()->unsigned();
            $table->integer('staff_no')->nullable();
            $table->integer('designation_id')->nullable()->unsigned();
            $table->integer('department_id')->nullable()->unsigned();
            $table->string('first_name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('full_name',200)->nullable();
            $table->string('fathers_name',100)->nullable();
            $table->string('mothers_name',100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->integer('gender_id')->nullable()->unsigned();
            $table->string('email',50)->nullable();
            $table->string('mobile',50)->nullable();
            $table->string('emergency_mobile',50)->nullable();
            $table->string('marital_status',30)->nullable();
            $table->string('merital_status',30)->nullable();
            $table->string('staff_photo')->nullable();
            $table->string('current_address',500)->nullable();
            $table->string('permanent_address',500)->nullable();
            $table->string('qualification',200)->nullable();
            $table->string('experience',200)->nullable();
            $table->string('epf_no',20)->nullable();
            $table->string('basic_salary',200)->nullable();
            $table->string('contract_type',200)->nullable();
            $table->string('location',50)->nullable();
            $table->string('casual_leave',15)->nullable();
            $table->string('medical_leave',15)->nullable();
            $table->string('metarnity_leave',15)->nullable();
            $table->string('bank_account_name',50)->nullable();
            $table->string('bank_account_no',50)->nullable();
            $table->string('bank_name',20)->nullable();
            $table->string('bank_brach',30)->nullable();
            $table->string('facebook_url',100)->nullable();
            $table->string('twiteer_url',100)->nullable();
            $table->string('linkedin_url',100)->nullable();
            $table->string('instragram_url',100)->nullable();
            $table->string('joining_letter',500)->nullable();
            $table->string('resume',500)->nullable();
            $table->string('other_document',500)->nullable(); 
            $table->string('notes',500)->nullable();
            $table->tinyInteger('active_status')->default(1);

            $table->string('driving_license',255)->nullable();
            $table->date('driving_license_ex_date')->nullable();

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
        Schema::dropIfExists('sm_staffs');
    }
}
