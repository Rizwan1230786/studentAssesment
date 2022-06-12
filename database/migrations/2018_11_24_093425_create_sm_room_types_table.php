<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmRoomType;
class CreateSmRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_room_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 255);
            $table->text('description')->nullable();
            $table->bigInteger('school_id')->nullable()->default(1);
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable()->default(1);
            $table->string('updated_by')->nullable()->default(1);
            $table->timestamps();
        });
  

    $data =[
        ['Single','A room assigned to one person. May have one or more beds.'],
        ['Double','A room assigned to two people. May have one or more beds.'],
        ['Triple','A room assigned to three people. May have two or more beds'],
        ['Quad','A room assigned to four people. May have two or more beds.'],
        ['Queen','A room with a queen-sized bed. May be occupied by one or more people'],
        ['King','A room with a king-sized bed. May be occupied by one or more people.'] 
    ];  

    foreach ($data as $row) {
        $store = new SmRoomType();
        $store->type =$row[0];
        $store->description =$row[1];
        $store->save();
    }

  }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_room_types');
    }
}
