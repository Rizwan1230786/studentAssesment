<?php

use App\SmSchool;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class SmSchoolTableSeeder extends Seeder
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
            $store= new SmSchool();
            $store->school_name=$faker->company." "."School";
            $store->created_by=$i;
            $store->save();

        }
    }
}
