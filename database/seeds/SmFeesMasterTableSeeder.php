<?php

use App\SmFeesMaster;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class SmFeesMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1; $i<=3; $i++){
            $store= new SmFeesMaster();
            $store->fees_group_id=$i;
            $store->fees_type_id=1;
            $store->date=$faker->dateTime()->format('Y-m-d');
            $store->amount=null;
            $store->date=$faker->dateTime()->format('Y-m-d');
            $store->created_by=$i;
            $store->save();

        }
    }
}
