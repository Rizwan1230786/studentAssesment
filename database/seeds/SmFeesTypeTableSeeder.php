<?php


use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmFeesType;
class SmFeesTypeTableSeeder extends Seeder
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
            $store= new SmFeesType();
            $store->name=$faker->name;
            $store->code=$faker->ean8;
            $store->description=$faker->realText($maxNbChars = 200, $indexSize = 1);
            $store->school_id=$faker->randomDigit;
            $store->active_status=1;
            $store->created_by=$i;
            $store->save();

        }
    }
}
