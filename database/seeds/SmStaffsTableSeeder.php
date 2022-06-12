<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\GlobalVariable;
use App\User;

class SmStaffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
 

    public function run(){
        $obj = new GlobalVariable();
        $Names = $obj->Names;

        $staff_Id = [4,5,6,7,8,9];
        $basic_salary=3000;
        for($i=1; $i<30; $i++){
            $role_id= $i%6;
            $gender_id= 1+ $i%3;
            $designation_id=  1+ $i%7;
            $department_id=  1+ $i%7;

            //Staff name genarator 
            $name_index = array_rand($Names,8);
            $First_Name = $UserName = $Names[$name_index[0]];
            $Last_Name  = $Names[$name_index[1]];
            $Full_name  = $First_Name.' '.$Last_Name;

            //parents name genarator
            $Father_First_Name = $Father_User_Name = $Names[$name_index[2]];
            $Father_Last_Name = $Names[$name_index[3]];
            $Father_full_name=$Father_First_Name.' '.$Father_Last_Name;

            $Mother_First_Name = $Names[$name_index[4]];
            $Mother_Last_Name = $Names[$name_index[5]];
            $Mother_full_name=$Mother_First_Name.' '.$Mother_Last_Name;
            


            //insert staff user & pass
            $newUser            = new User();
            $newUser->role_id   =$staff_Id[$role_id];
            $newUser->full_name =$Full_name;
            $newUser->email     =$First_Name.$i.'@spondonit.com';
            $newUser->username  =$UserName.$i.'@spondonit.com';
            $newUser->password  = Hash::make(123456);
            $newUser->save();
            $newUser->toArray();
            $staff_id_number=$newUser->id; 




            DB::table('sm_staffs')->insert([

             [
                 'user_id'          =>$staff_id_number,
                 'role_id'          =>$staff_Id[$role_id],
                 'staff_no'         =>$i, 
                 'designation_id'   =>$designation_id, 
                 'department_id'    =>$department_id, 
                 'first_name'       =>$First_Name, 
                 'last_name'        =>$Last_Name, 
                 'full_name'        =>$Full_name, 
                 'fathers_name'     =>$Father_full_name, 
                 'mothers_name'     =>$Mother_full_name, 

                 'date_of_birth'    =>'1980-12-26', 
                 'date_of_joining'  =>'2019-05-26', 

                 'gender_id'        =>$gender_id, 
                 'email'            =>$First_Name.$i.'@spondonit.com', 
                 'mobile'           =>'+880123456790', 
                 'emergency_mobile' =>'+880123456790', 
                 'marital_status'   =>'Married', 
                 'staff_photo'      =>'public/uploads/staff/staff1.jpg',
                 'current_address'  =>'Pantopath, Dhaka-1219, Bangladesh', 
                 'permanent_address'=>'Pantopath, Dhaka-1219, Bangladesh', 
                 'qualification'    =>'B.Sc in Computer Science', 
                 'experience'       =>'4 Years', 
                 'basic_salary'     =>$basic_salary + $i,
                 'casual_leave'     =>'12',
                 'medical_leave'    =>'15', 
                 'metarnity_leave'  =>'45', 

                 'driving_license'  =>'56776987453', 
                 'driving_license_ex_date'=>'2019-02-23', 
             ] 


            ]);
        }
    }
}
