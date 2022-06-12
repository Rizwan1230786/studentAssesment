<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmRoomList;
class CreateSmRoomListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_room_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->tinyInteger('dormitory_id');
            $table->tinyInteger('room_type_id');
            $table->tinyInteger('number_of_bed');
            $table->integer('cost_per_bed')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('school_id')->nullable()->default(1);
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable()->default(1);
            $table->string('updated_by')->nullable()->default(1);
            $table->timestamps();
        });

        for($i=1; $i<5; $i++){
            for($j=1; $j<5; $j++){
                $store = new SmRoomList();
                $store->name = $i.'00'.$i;
                $store->dormitory_id = $i;
                $store->room_type_id = $j;
                $store->number_of_bed = $i;
                $store->cost_per_bed = 400*$i;
                $store->description = '';

                $store->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_room_lists');
    }
}
