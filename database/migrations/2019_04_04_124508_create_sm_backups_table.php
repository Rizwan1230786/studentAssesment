<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('sm_backups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name', 255)->nullable();
            $table->string('source_link', 255)->nullable();
            $table->tinyInteger('file_type')->nullable()->comment('0=Database, 1=File, 2=Image');
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        DB::table('sm_backups')->insert([
            [
                'file_name' => 'demoName',
                'source_link'=>'demo',
            ],
            [
                'file_name' => 'demoName1',
                'source_link'=>'demo',
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
        Schema::dropIfExists('sm_backups');
    }
}
