<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use App\SmParent;
use App\GlobalVariable;
class SmStudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
 

    public function run(){
        
    	$obj = new GlobalVariable();
    	$Names = $obj->Names;

	$base_Id =  ['Male', 'Female',  'Others', 'Islam', 'Hinduism', 'Sikhism', 'Buddhism',  'Protestantism',  'A+',  'O+',  'B+',  'AB+',  'A-',  'O-',  'B-',  'AB-'];

        for($i=20; $i<100; $i++){
            $gender_id= 1+ $i%2;  



            //student name genarator 
            $name_index = array_rand($Names,8);
            $student_First_Name = $student_User_Name = $Names[$name_index[0]];
            $student_Last_Name = $Names[$name_index[1]];
            $student_full_name=$student_First_Name.' '.$student_Last_Name;


            //parents name genarator
            $Father_First_Name = $Father_User_Name = $Names[$name_index[2]];
            $Father_Last_Name = $Names[$name_index[3]];
            $Father_full_name=$Father_First_Name.' '.$Father_Last_Name;

            $Mother_First_Name = $Names[$name_index[4]];
            $Mother_Last_Name = $Names[$name_index[5]];
            $Mother_full_name=$Mother_First_Name.' '.$Mother_Last_Name;



            //guardians name gebarator
            $Guardian_First_Name = $Names[$name_index[6]];
            $Guardian_Last_Name = $Names[$name_index[7]];
            $Guardian_full_name=$Guardian_First_Name.' '.$Guardian_Last_Name;


            
            //insert student user & pass
            $newUser = new User();
            $newUser->role_id=2;
            $newUser->full_name=$student_full_name;
            $newUser->email=$student_User_Name.$i.'@spondonit.com';
            $newUser->username=$student_User_Name.$i.'@spondonit.com';
            $newUser->password= Hash::make(123456);
            $newUser->save();
            $newUser->toArray();
            $student_id=$newUser->id; 



            //insert student user & pass
            $newUser = new User();
            $newUser->role_id=3;
            $newUser->full_name=$Father_full_name;
            $newUser->email=$Father_User_Name.$i.'@spondonit.com';
            $newUser->username=$Father_User_Name.$i.'@spondonit.com';
            $newUser->password= Hash::make(123456);
            $newUser->save();
            $newUser->toArray();
            $parents_id=$newUser->id;           

        $parent = new SmParent();
        $parent->user_id                = $parents_id;

        $parent->fathers_name           = $Father_full_name;
        $parent->fathers_mobile         = rand(1000, 9999) . rand(1000, 9999);
        $parent->fathers_occupation     = 'Teacher';
        $parent->fathers_photo          = 'public/uploads/staff/father.png';

        $parent->mothers_name           = $Mother_full_name;
        $parent->mothers_mobile         = rand(1000, 9999) . rand(1000, 9999);
        $parent->mothers_occupation     = 'Housewife';
        $parent->mothers_photo          = 'public/uploads/staff/mother.jpg';


        $parent->guardians_name         = $Guardian_full_name;
        $parent->guardians_mobile       = rand(1000, 9999) . rand(1000, 9999);
        $parent->guardians_email        = $Guardian_First_Name.$i.'@spondonit.com';
        $parent->guardians_occupation   = 'Businessman';
        $parent->guardians_relation     = 'Brother';
        $parent->relation               = 'Son';
        $parent->guardians_photo        = 'public/uploads/staff/sample.png';


        $parent->guardians_address = 'Dhaka-1219, Bangladesh';
        $parent->is_guardian = 1;
        $parent->save();
        $parent->toArray();
        $parents_id=$parent->id; 

 

            DB::table('sm_students')->insert([
             [
                 'user_id'=>$student_id, 
                 'parent_id'=>$parents_id, 
                 'admission_no'=>$i, 
                 'roll_no'=>$i, 
                 'class_id'=>1+$i%5, 
                 'student_category_id'=>1, 
                 'section_id'=>1+$i%2,  
                 'session_id'=>1,   
                 'caste'=>'Asian', 
                 'bloodgroup_id'=>8+$i%8, 

                 'route_list_id'=>1+$i%2, 
                 'dormitory_id'=>1+$i%2, 
                 'vechile_id'=>1+$i%2, 
                 'room_id'=>1+$i%2, 
                 'driver_id'=>1+$i%2, 
                 'national_id_no'=>'237864238764'.$i*$i, 
                 'local_id_no'=>'237864238764'.$i*$i, 

                 'religion_id'=>3+$i%5, 
                 'height'=>56, 
                 'weight'=>45, 
 
                 'first_name'=>$student_First_Name, 
                 'last_name'=>$student_Last_Name, 
                 'full_name'=>$student_full_name,  

                 'date_of_birth'=>'1980-12-26', 
                 'admission_date'=>'2019-05-26', 

                 'gender_id'=>$gender_id, 
                 'email'=>$student_First_Name.'@infix.com', 
                 'mobile'=>'+8801234567'.$i, 
                 'bank_account_no'=>'+8801234567'.$i, 

                 'bank_name'=>'DBBL', 
                 'student_photo'=>'public/uploads/staff/std1.jpg',


                 'current_address'=>'Bangladesh', 
                 'previous_school_details'=>'Bangladesh', 
                 'aditional_notes'=>'Bangladesh', 

                 'permanent_address'=>'Bangladesh'
             ] 


            ]);
             


        }

        
    }
}
