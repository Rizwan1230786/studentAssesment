<?php

use App\SmStudentHomework;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SmStudentHomeworkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $i = 1;

        for ($student_id = 1; $student_id <= 5; $student_id++) {
            for ($subject_id = 1; $subject_id <= 2; $subject_id++) {
                $store = new SmStudentHomework();
                $store->student_id = $student_id;
                $store->subject_id = $subject_id;
                $store->homework_date = $faker->dateTime()->format('Y-m-d');
                $store->submission_date = $faker->dateTime()->format('Y-m-d');;
                $store->description = $faker->text(500);
                $store->percentage = 40;
                $store->evaluated_by = $i;
                $store->status = 1;
                $store->created_by = $i++;

                $store->save();


            }

        }
    }
}
