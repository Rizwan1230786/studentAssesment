<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmGeneralSettings;
use DB;
use App\User;
use App\Quotation;
use Session;
use App\Envato\Envato;
use Hash;
use App\SmStaff;
use GuzzleHttp\Client;


class InstallController extends Controller
{


    public function show_welcome_screen(){
        if (\Schema::hasTable('users')) {
            $testInstalled = DB::table('users')->get();
            if (count($testInstalled) < 1) {
                return view('install.install_welcome');
            } else {
                return redirect('login');
            }
        } else {
            return view('install.install_welcome');
        }
    }

    public function purchase_verification_form(){ 
        return view('install.purchase_verification_form'); 
    }

    public function environment_setup(){ 
        $path = '';
        $folders = array( $path . "/public", $path . "/storage" ); 
        return view('install.environment_setup')->with('folders', $folders); 
    }
    public function system_setting_form(){ 
        return view('install.system_setting_form'); 
    }


    



 

    public function purchase_verified_check(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'purchase_code' => 'required',
            'purchase_domain' => 'required',
        ]);

        $client = new Client();

        $email = htmlspecialchars($request->input('email'));
        $purchase_code = htmlspecialchars($request->input('purchase_code'));
        $domain = htmlspecialchars($request->input('purchase_domain'));
        $product_info = $client->request('GET', 'http://salespanel.infixedu.com/api/verify/'.$purchase_code.'/'.$domain);
        $product_info = $product_info->getBody()->getContents();
        $product_info = json_decode($product_info);

        
        if($product_info->data->product_info != ""){

            $res = $client->request('GET', 'http://salespanel.infixedu.com/api/verified/email/'.$purchase_code.'/'.$email);

            Session::put('email', $email);
            Session::put('purchase_code', $purchase_code);
            Session::put('domain', $domain);

            Session::put('purchase_verified', 'true');
            \Session::flash("message-success", "Congratulations! Purchase code is verified.");
            return redirect('/environment-setup');

        }else{
            Session::put('purchase_verified', 'false');
            \Session::flash("message-danger", "Ops! Purchase Code is not valid. Please try again.");
            return redirect()->back();
           
        }

    }

  

    public function system_setting_install(Request $request){
     
        $this->validate($request, [
            'institution_name' => 'required',
            'institution_code' => 'required',
            'institution_address' => 'required',
            'session_year' => 'required', 
            'system_admin_email' => 'required',
            'demo_data' => 'required',
            'system_admin_password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'

        ]);

        set_time_limit(900);
        \Artisan::call('migrate:refresh');

        if($request->input('demo_data') == 2)
        {
            \Artisan::call('db:seed');
        }


        if (\Schema::hasTable('migrations')) {
            $migration = DB::table('migrations')->get();
            if (count($migration) > 0) { 
                $is_existing_settings = SmGeneralSettings::find(1);
                if ($is_existing_settings != "") {
                    $is_existing_settings->school_name = $request->input('institution_name');
                    $is_existing_settings->site_title = $request->input('institution_name');
                    $is_existing_settings->school_code = $request->input('institution_code');
                    $is_existing_settings->address = $request->input('institution_address');
                    $is_existing_settings->session_year = $request->input('session_year');
                    $is_existing_settings->language_id = $request->input('currency_format');
                    $is_existing_settings->currency = $request->input('institution_name');
                    $is_existing_settings->system_purchase_code = Session::get('purchase_code');
                    $is_existing_settings->system_domain = Session::get('domain');
                    $is_existing_settings->email = Session::get('email');
                    $is_existing_settings->save();

                } else {
                    $setting = new SmGeneralSettings();
                    $setting->school_name = $request->input('institution_name');
                    $setting->school_code = $request->input('institution_code');
                    $setting->address = $request->input('institution_address');
                    $setting->session_year = $request->input('session_year');
                    $setting->language_id = $request->input('language_select');
                    $setting->currency = $request->input('currency_format');
                    $setting->system_purchase_code = Session::get('purchase_code');
                    $setting->system_domain = Session::get('domain');
                    $setting->email = Session::get('email');
                    $setting->save();

                }

                $user = new User();
                $user->role_id = 1;
                $user->username = $request->input('system_admin_email');
                $user->full_name = 'system administrator';
                $user->email = $request->input('system_admin_email');
                $user->password = Hash::make($request->input('system_admin_password'));
                $user->save();
                $user->toArray();



                $staff = new SmStaff();

                 $staff->user_id        = $user->id;
                 $staff->role_id        = 1;
                 $staff->staff_no       = 1;
                 $staff->designation_id = 1;
                 $staff->department_id  = 1; 
                 $staff->first_name     = 'System'; 
                 $staff->last_name      = 'Administrator'; 
                 $staff->full_name      = 'System Administrator';  

                 $staff->date_of_birth      = '1980-12-26';  
                 $staff->gender_id          = 1; 
                 $staff->email              = $request->input('system_admin_email');  
                 $staff->staff_photo        = '/public/backEnd/img/admin/avatar.png';  
                 $staff->save();

                if ($user) {
                    return redirect('login');

                } else {
                    \Artisan::call('migrate:reset');
                    \Session::flash("message-danger", "Ops! Something went wrong! Please try again.");
                    return redirect()->back();

                }


            }else{
                    \Artisan::call('migrate:reset');
                    \Session::flash("message-danger", "Ops! Something went wrong! Please try again.");
                    return redirect()->back();

            }

        }


    }


    public function verifiedCode(){

        if (\Schema::hasTable('sm_general_settings')) {
            $GetData = DB::table('sm_general_settings')->find(1);
            if(!empty($GetData)){
                $obj = Envato::verifyPurchase($GetData->system_purchase_code);
                if (!empty($obj)) {
                    foreach ($obj as $data) {
                        if (!empty($data['item_id'])) {
                            return redirect('/');
                        }
                    }
                }
            }
        }

        return view('install.verified_code');
    }

    public function verifiedCodeStore(Request $request){
        $client = new Client(); 
        $email = htmlspecialchars($request->input('email'));
        $purchase_code = htmlspecialchars($request->input('purchase_code'));
        $domain = htmlspecialchars($request->input('purchase_domain')); 
        $product_info = $client->request('GET', 'http://salespanel.infixedu.com/api/installation/'.$purchase_code.'/'.$domain.'/'.$email); 
        $product_info = $product_info->getBody()->getContents(); 
        $product_info = json_decode($product_info); 
        dd($product_info);
        
        if($product_info->data->product_info != ""){ 
            $res = $client->request('GET', 'http://salespanel.infixedu.com/api/verified/email/'.$purchase_code.'/'.$email); 
            return redirect('login');

        }else{

            \Session::flash("message-danger", "Ops! Purchase Code is not vaild. Please try again.");
            return redirect()->back();
           
        }
    }


}
