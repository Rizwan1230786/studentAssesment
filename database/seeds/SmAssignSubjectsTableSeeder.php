<?php

use Illuminate\Database\Seeder;

class SmAssignSubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    
        $section_id=[1,2,3,4,5];
        $subject_id=[1,2,3];
        $class_id=[1,2,3,4,5,6,7,8,9,10];
        foreach ($class_id as $class) {  
            foreach ($subject_id as $subject) { 
                foreach ($section_id as $section) {  
                    DB::table('sm_assign_subjects')->insert([
                        [
                             'class_id'=> $class,
                             'section_id'=>$section ,
                             'teacher_id' =>$class+$section+$subject,
                             'subject_id' => $subject,
                        ]
                    ]);
                }
            }
        }

    }




}
