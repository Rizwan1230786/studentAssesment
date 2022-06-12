<?php

use Illuminate\Database\Seeder;

class Sm_phone_call_logsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('sm_phone_call_logs')->insert([
          [
              'name'=>'Abhi',
              'phone'=>'0187847855',
              'date'=>'2019-04-12',
              'description'=>'kjdfkgdk',
              'next_follow_up_date'=>'2019-04-12',
              'call_duration'=>'854',
              'call_type'=>'2',
              'school_id'=>'3103',
              'active_status'=>'1'
          ],
          [
              'name'=>'Rashed',
              'phone'=>'0187847855',
              'date'=>date('Y-m-d'),
              'description'=>'kjdfkgdk',
              'next_follow_up_date'=>date('Y-m-d'),
              'call_duration'=>'854',
              'call_type'=>'2',
              'school_id'=>'3103',
              'active_status'=>'1'
          ]

        ]);
    }
}
