<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmVehicle;
class CreateSmVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle_no', 30);
            $table->string('vehicle_model', 30);
            $table->integer('made_year')->nullable();
            $table->string('driver_id')->nullable();
            $table->text('note')->nullable();
            $table->bigInteger('school_id')->nullable()->default(1);
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable()->default(1);
            $table->string('updated_by')->nullable()->default(1);
            $table->timestamps();
        });

        $store = new SmVehicle();
        $store->vehicle_no = 'V1-345678';
        $store->vehicle_model = 'ML-345678';
        $store->made_year = '2002';
        $store->driver_id =1;
        $store->note ='This driver is very hard working person !';
        $store->save();

        $store = new SmVehicle();
        $store->vehicle_no = 'V1-345678';
        $store->vehicle_model = 'ML-345678';
        $store->made_year = '2002';
        $store->driver_id =2;
        $store->note ='This driver is very hard working person !';
        $store->save();

        $store = new SmVehicle();
        $store->vehicle_no = 'V1-345678';
        $store->vehicle_model = 'ML-345678';
        $store->made_year = '2002';
        $store->driver_id =3;
        $store->note ='This driver is very hard working person !';
        $store->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_vehicles');
    }
}
