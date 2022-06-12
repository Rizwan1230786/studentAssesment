<?php

use Illuminate\Database\Seeder;

class SmClassRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
 
        DB::table('sm_class_rooms')->insert([
        	[
        		'room_no'=>'Room 101',
        		'capacity'=>60,
        		'active_status'=>1,

        	],
        	[
        		'room_no'=>'Room 102',
        		'capacity'=>55,
        		'active_status'=>1,

        	],
        	[
        		'room_no'=>'Room 103',
        		'capacity'=>55,
        		'active_status'=>1,

        	],
        	[
        		'room_no'=>'Room 104',
        		'capacity'=>60,
        		'active_status'=>1,

        	], 
        	
        	[
        		'room_no'=>'Room 201',
        		'capacity'=>60,
        		'active_status'=>1,

        	],
        	[
        		'room_no'=>'Room 202',
        		'capacity'=>55,
        		'active_status'=>1,

        	],
        	[
        		'room_no'=>'Room 203',
        		'capacity'=>55,
        		'active_status'=>1,

        	],
        	[
        		'room_no'=>'Room 204',
        		'capacity'=>60,
        		'active_status'=>1,

        	], 

        ]);




    }
}
