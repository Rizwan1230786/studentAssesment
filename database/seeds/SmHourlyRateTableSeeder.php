<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmHourlyRate;
class SmHourlyRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1; $i<=5; $i++){
            $store= new SmHourlyRate();
            $store->grade="A+";
            $store->rate=20;
            $store->school_id=$faker->ean8;
            $store->active_status=1;
            $store->created_by=$i;
            $store->save();

        }

    }
}
