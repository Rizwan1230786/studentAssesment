<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmQuestionLevel;
class SmquestionLevelTableSeeder extends Seeder
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
            $store= new SmQuestionLevel();
            $store->level=$faker->word;
            $store->created_by=$i;
            $store->save();

        }
    }
}
