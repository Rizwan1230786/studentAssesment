<?php

use Illuminate\Database\Seeder;

class SmExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 

        
        DB::table('sm_exam_types')->insert([

         [
             'school_id'=> 1,
             'active_status'=> 1,
             'title' => 'First Term'
         ],
         [
             'school_id'=> 1,
             'active_status'=> 1,
             'title' => 'Second Term'
         ],
         [
             'school_id'=> 1,
             'active_status'=> 1,
             'title' => 'Third Term'
         ],

        ]);

    }
}
