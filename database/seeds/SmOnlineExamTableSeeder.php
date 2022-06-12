<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmOnlineExam;
class SmOnlineExamTableSeeder extends Seeder
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
        for($class_id=1; $class_id<=3; $class_id++){
            for($section_id=1; $section_id<=3; $section_id++){
                for($subject_id=1; $subject_id<=3; $subject_id++){
                    $store = new SmOnlineExam();

                    $store->subject_id = $subject_id;
                    $store->class_id = $class_id;
                    $store->section_id = $section_id;
                    $store->title =$faker->realText($maxNbChars = 30, $indexSize = 1);
                    $store->date = $faker->dateTime()->format('Y-m-d');
                    $store->start_time =$faker->time($format = 'H:i A', $max = 'now');
                    $store->end_time = $faker->time($format = 'H:i A', $max = 'now');
                    $store->end_date_time =$faker->dateTime()->format('Y-m-d')." ".$faker->time($format = 'H:i A', $max = 'now');
                    $store->percentage = 50;
                    $store->instruction = $faker->realText($maxNbChars = 100, $indexSize = 1);
                    $store->status = $faker->numberBetween(0,1);
                    $store->school_id = $faker->ean8;
                    $store->status = 1;
                    $store->active_status =$faker->numberBetween(0,1);
                    $store->created_by = $i++;

                    $store->save();

                }
            }
        }
    }
}
