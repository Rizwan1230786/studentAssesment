<?php

use Illuminate\Database\Seeder;

class Sm_Class_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
              DB::table('sm_classes')->insert([
                [
                    'class_name' => 'One', 
                ],
                [
                    'class_name' => 'Two', 
                ],
                [
                    'class_name' => 'Three', 
                ],
                [
                    'class_name' => 'Four',
                ],
                [
                    'class_name' => 'Five', 
                ],
                [
                    'class_name' => 'Six', 
                ],
                [
                    'class_name' => 'Seven', 
                ],
                [
                    'class_name' => 'Eight', 
                ],
                [
                    'class_name' => 'Nine', 
                ],
                [
                    'class_name' => 'Ten', 
                ]
            ]);

    }
}
