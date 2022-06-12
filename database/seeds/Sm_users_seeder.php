<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\SmStaff;

class Sm_users_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->role_id = 1;
        $user->full_name = 'Super Admin';
        $user->email = 'jahanzaib.shakeel.75@gmail.com';
        $user->username = 'superadmin';
        $user->password = Hash::make(123456);
        $user->save();
        $user->toArray();


         $staff = new SmStaff();

         $staff->user_id  = $user->id;
         $staff->role_id  = 1;
         $staff->staff_no  = 1;
         $staff->designation_id  = 1;
         $staff->department_id  = 1; 
         $staff->first_name  = 'Super'; 
         $staff->last_name  = 'Admin'; 
         $staff->full_name  = 'Super Admin'; 
         $staff->fathers_name  = 'NA'; 
         $staff->mothers_name  = 'NA'; 

         $staff->date_of_birth  = '1980-12-26'; 
         $staff->date_of_joining  = '2019-05-26'; 

         $staff->gender_id  = 1; 
         $staff->email  = 'superadmin@infix.com'; 
         $staff->mobile  = ''; 
         $staff->emergency_mobile  = ''; 
         $staff->merital_status  = '';
         $staff->staff_photo  = 'public/uploads/staff/3a7572c3396cc23022030d1079ebcb00.jpg'; 


         $staff->current_address  = ''; 
         $staff->permanent_address  = ''; 
         $staff->qualification  = ''; 
         $staff->experience  = ''; 



         $staff->casual_leave  = '12'; 
         $staff->medical_leave  = '15'; 
         $staff->metarnity_leave  = '45'; 


         $staff->driving_license  = ''; 
         $staff->driving_license_ex_date  = '2019-02-23';
         $staff->save();


    }
}
