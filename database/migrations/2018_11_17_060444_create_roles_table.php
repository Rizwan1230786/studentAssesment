<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable();
            $table->string('type')->default('System');
            $table->bigInteger('school_id')->nullable()->default(1);
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable()->default(1);
            $table->string('updated_by')->nullable()->default(1);
            $table->timestamps();
        }); 

        
        DB::table('roles')->insert([
            [
                'name' => 'Super admin',    //      1
                'type' => 'System'
            ],
            [
                'name' => 'Student',    //      2
                'type' => 'System'
            ],
            [
                'name' => 'Parents',    //      3
                'type' => 'System'
            ],
            [
                'name' => 'Teacher',    //      4
                'type' => 'System'
            ],
            [
                'name' => 'Admin',    //      5
                'type' => 'System'
            ],
            [
                'name' => 'Accountant',    //      6
                'type' => 'System'
            ],
            [
                'name' => 'Receptionist',    //      7
                'type' => 'System'
            ],
            [
                'name' => 'Librarian',    //      8
                'type' => 'System'
            ],
            [
                'name' => 'Driver',    //      9
                'type' => 'System'
            ],
            [
                'name' => 'Customer',    //      10
                'type' => 'System'
            ]

        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
