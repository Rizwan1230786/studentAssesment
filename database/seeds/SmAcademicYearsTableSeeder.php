<?php

use Illuminate\Database\Seeder;

class SmAcademicYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('sm_academic_years')->insert([
            [
                'year' => '2018',
                'title' => '2018 Year',
                'starting_date' => '2018-01-01',
                'ending_date' => '2018-12-31',
            ], 
            [
                'year' => '2019',
                'title' => '2019 Year',
                'starting_date' => '2019-01-01',
                'ending_date' => '2019-12-31',
            ], 
            [
                'year' => '2020',
                'title' => '2020 Year',
                'starting_date' => '2020-01-01',
                'ending_date' => '2020-12-31',
            ], 
        ]);
    }
}
