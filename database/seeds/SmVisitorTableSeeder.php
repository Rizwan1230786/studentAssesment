<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmVisitor;

class SmVisitorTableSeeder extends Seeder
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
            $store= new SmVisitor();
            $store->name=$faker->name;
            $store->phone=$faker->tollFreePhoneNumber;
            $store->visitor_id=$i;
            $store->no_of_person=$faker->numberBetween(1,10);
            $store->purpose=$faker->word;
            $store->date=$faker->dateTime()->format('Y-m-d');
            $store->in_time=$faker->time($format = 'H:i A', $max = 'now');
            $store->out_time=$faker->time($format = 'H:i A', $max = 'now');
            $store->file='public/uploads/visitor/visitor.jpg';
            $store->school_id=$i;
            $store->active_status=1;
            $store->created_by=$i;
            $store->save();

        }
    }
}
