<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmDormitoryListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_dormitory_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dormitory_name', 30);
            $table->string('type')->comment('B=Boys, G=Girls');
            $table->string('address')->nullable();
            $table->integer('intake')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('school_id')->nullable()->default(1);
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable()->default(1);
            $table->string('updated_by')->nullable()->default(1);
            $table->timestamps();
        });

 

        $dormitory = [
            'Sir Isaac Newton Hostel',
            'Louis Pasteur Hostel',
            'Galileo Hostel',
            'Marie Curie Hostel',
            'Albert Einstein Hostel',
            'Charles Darwin Hostel',
            'Nikola Tesla Hostel'
        ];


        foreach ($dormitory as $data) {
            DB::table('sm_dormitory_lists')->insert([
                [
                    'dormitory_name'=>$data,
                    'type'=>'B',
                    'address'=>'25/13, Sukrabad Rd, Tallahbag, Dhaka 1215',
                    'intake'=>120,
                    'description'=>'Hostels provide lower-priced, sociable accommodation where guests can rent a bed, usually a bunk bed, in a dormitory and share a bathroom, lounge and sometimes a kitchen.', 
                ]
            ]);
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_dormitory_lists');
    }
}
