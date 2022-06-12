<?php

use Illuminate\Database\Seeder;

class SmDesignationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
 
   
       DB::table('sm_designations')->insert([
            [
               'title'=>'Headmaster', 
            ],
            [
               'title'=>'Assistant Head Master', 
            ],
            [
               'title'=>'Assistant Teacher', 
            ],
            [
               'title'=>'Senior Teacher', 
            ],
            [
               'title'=>'Senior Assistant Teacher', 
            ], 
            [
               'title'=>'Faculty', 
            ], 
            [
               'title'=>'Accountant', 
            ], 
            [
               'title'=>'Librarian', 
            ], 
            [
               'title'=>'Admin', 
            ], 
            [
               'title'=>'Receptionist', 
            ], 
            [
               'title'=>'Principal', 
            ], 
            [
               'title'=>'Director', 
            ]


        ]);


    }
}
