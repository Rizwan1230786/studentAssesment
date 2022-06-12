<?php

use Illuminate\Database\Seeder;

class SmHumanDepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
       DB::table('sm_human_departments')->insert([
            [
               'name'=>'Academic',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Admin',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Arts',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Commerce',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Library',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Sports',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Science',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Exam',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Finance',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Health',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Technology',
               'school_id'=>1,
               'active_status'=>1,
            ],
            [
               'name'=>'Music and Theater',
               'school_id'=>1,
               'active_status'=>1,
            ]
        ]);
    }
}
