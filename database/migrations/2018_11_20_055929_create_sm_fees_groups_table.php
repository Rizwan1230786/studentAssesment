<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmFeesGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_fees_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('type', 30)->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('school_id')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
        DB::table('sm_fees_groups')->insert([
            [
                'name' => 'Transport Fee',
                'type' => 'System'
            ],
            [
                'name' => 'Dormitory Fee',
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
        Schema::dropIfExists('sm_fees_groups');
    }
}
