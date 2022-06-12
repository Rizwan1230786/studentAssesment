<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmQuestionBank;
class SmQuestionBanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        $i=1;
        for($q_group_id=1; $q_group_id<=5; $q_group_id++) {
            for ($class_id = 1; $class_id <= 3; $class_id++) {
                for ($section_id = 1; $section_id <= 5; $section_id++) {
                    $store = new SmQuestionBank();

                    $store->q_group_id = $q_group_id;
                    $store->class_id = $class_id;
                    $store->section_id = $section_id;
                    $store->type = 'M';
                    $store->question = $faker->realText($maxNbChars = 80, $indexSize = 1);
                    $store->marks = 100;
                    $store->trueFalse = 'T';
                    $store->suitable_words = $faker->realText($maxNbChars = 50, $indexSize = 1);
                    $store->number_of_option = 4;
                    $store->created_by = $i++;

                    $store->save();

                }
            }
        }

    }
}
