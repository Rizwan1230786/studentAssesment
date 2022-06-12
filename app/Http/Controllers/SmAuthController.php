<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SmAuthController extends Controller
{
    public function getLoginAccess(Request $request){
    	if($request->value == "Student"){
    		$user = User::where('role_id', 2)->first();
    	}elseif($request->value == "Parents"){
    		$user = User::where('role_id', 3)->first();
    	}elseif($request->value == "Super Admin"){
    		$user = User::where('role_id', 1)->first();
    	}elseif($request->value == "Admin"){
    		$user = User::where('role_id', 5)->first();
    	}elseif($request->value == "Teacher"){
    		$user = User::where('role_id', 4)->first();
    	}elseif($request->value == "Accountant"){
    		$user = User::where('role_id', 6)->first();
    	}elseif($request->value == "Receptionist"){
    		$user = User::where('role_id', 7)->first();
    	}elseif($request->value == "Librarian"){
    		$user = User::where('role_id', 8)->first();
    	}
        return response()->json($user);
    }

    public function recoveryPassord(){
    	return view('auth.recovery_password');
    }

    public function emailVerify(Request $request){
    	$request->validate([
    		'email' => 'required'
    	]);

    	$emailCheck = User::select('*')->where('email', $request->email)->first();


        if($emailCheck == ""){
            return redirect()->back()->with('message-danger', "Invalid Email, Please try again");
        }else{

        	$data['email'] = $request->email; 
        	$data['random'] = Str::random(32);

        	$user = User::where('email', $request->email)->first();
        	$user->random_code = $data['random'];
        	$user->save();


        	Mail::send('auth.confirmation_reset', compact('data'), function($message) use($request) {
		        $message->to($request->email, 'Tutorials Point')->subject
		            ('Reset Password');
		         $message->from('spn5@spondonit.com','Spondon IT');
		      });
		     

              return redirect()->back()->with('message-success', 'Success ! Please check your email');
        }
    }

    public function resetEmailConfirtmation($email, $code){
    	$user = User::where('email', $email)->where('random_code', $code)->first();
    	if($user != ""){
    		$email = $user->email;
    		return view('auth.new_password', compact('email'));
    	}else{
    		return redirect('recovery/passord')->with('message-danger', 'You have clicked on a invalid link, please try again');
    	}
    }

    public function storeNewPassword(Request $request){
    	$request->validate([
    		'new_password' => 'required|same:confirm_password',
    		'confirm_password' => 'required'
    	]);

    	$user = User::where('email', $request->email)->first();
    	$user->password = Hash::make($request->new_password);
    	$user->random_code = '';
    	$result = $user->save();

    	if($result){
    		return redirect('login')->with('message-success', 'Password has beed reset successfully');	
    	}else{
    		return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
    	}
    }
}
