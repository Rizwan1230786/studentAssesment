<?php

use Illuminate\Database\Seeder;

class SmSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('sm_sessions')->insert([
            [
                'session' => '2019'
            ], 
            [
                'session' => '2020'
            ], 
            [
                'session' => '2021'
            ], 
        ]);
    }
}
