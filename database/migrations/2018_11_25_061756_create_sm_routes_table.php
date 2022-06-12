<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmRoute;
class CreateSmRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 30);
            $table->float('far');
            $table->bigInteger('school_id')->nullable()->default(1);
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable()->default(1);
            $table->string('updated_by')->nullable()->default(1);
            $table->timestamps();
        });

        $store = new SmRoute();
        $store->title = 'School To Shahabag';
        $store->far = 100; 
        $store->save();

        $store = new SmRoute();
        $store->title = 'School To Malibag';
        $store->far = 100; 
        $store->save();

        $store = new SmRoute();
        $store->title = 'School To Dhanmondhi';
        $store->far = 100; 
        $store->save();

        $store = new SmRoute();
        $store->title = 'School To New Market';
        $store->far = 100; 
        $store->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_routes');
    }
}
