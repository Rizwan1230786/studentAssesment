<?php

use Illuminate\Database\Seeder;
use App\SmClassSection;
class Sm_class_section_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        for($class_id=1; $class_id<=10; $class_id++){
            for($section_id=1; $section_id<=4; $section_id++){
                $s= new SmClassSection();
                $s->class_id = $class_id;
                $s->section_id = $section_id;$s->save();
            }
        }
         
    }
}
