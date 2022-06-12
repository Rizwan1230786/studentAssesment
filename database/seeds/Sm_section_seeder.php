<?php

use Illuminate\Database\Seeder;

class Sm_section_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('sm_sections')->insert([

         [
             'section_name'=>'A', 
         ], 

         [
             'section_name'=>'B', 
         ], 

         [
             'section_name'=>'C', 
         ], 

         [
             'section_name'=>'D', 
         ], 
         [
             'section_name'=>'E', 
         ], 


        ]);
    }
}
