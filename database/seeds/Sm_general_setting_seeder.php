<?php

use Illuminate\Database\Seeder;

class Sm_general_setting_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sm_general_settings')->insert([

         [
             'school_name'=>'',
             'site_title'=>'',
             'school_code'=>'',
             'address'=>'',
             'phone'=>'',
             'email'=>'',
             'system_purchase_code'=>'',
             'envato_user'=>'',
             'envato_item_id'=>'',
             'system_domain'=>'',
             'copyright_text'=>'Copyright &copy; 2019 All rights reserved | This template is made with <span class="ti-heart"> </span> by Codethemes',
             'logo'=>'public/uploads/settings/logo.png',
             'favicon'=>'public/uploads/settings/favicon.png',
             'currency'=>'USD'

         ]
        ]);
    }
}
