<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmSmsGateway;
use App\SmGeneralSettings;
use App\SmSession;
use App\SmLanguage;
use App\SmCurrency;
use App\SmCountry;
use App\SmLanguagePhrase;
use App\SmDateFormat;
use App\SmEmailSetting;
use App\SmPaymentMethhod;
use App\SmPaymentGatewaySetting;
use App\SmBackup;
use App\SmModule;
use App\Language;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use ZipArchive;
use RecursiveIteratorIterator;

use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;


use Validator;

use DB;

class SmSystemSettingController extends Controller
{

  public function __construct()
  {
      $this->middleware('PM');
  }

  

    public function smsSettings(){
      $sms_services = SmSmsGateway::all();
      $active_sms_service = SmSmsGateway::select('id')->where('active_status', 1)->first();
      return view('backEnd.systemSettings.smsSettings', compact('sms_services', 'active_sms_service'));
    }



    public function languageSettings(){
      $sms_languages = SmLanguage::all();
      $all_languages= DB::table('languages')->orderBy('code','ASC')->get();
      return view('backEnd.systemSettings.languageSettings', compact('sms_languages','all_languages'));
    }





    public function languageEdit( $id){

      $selected_languages = SmLanguage::find($id);
      $sms_languages = SmLanguage::all();
      $all_languages= DB::table('languages')->orderBy('code','ASC')->get();
      return view('backEnd.systemSettings.languageSettings', compact('sms_languages','all_languages','selected_languages'));

    }

    public function languageUpdate(Request $request){
      $id               =   $request->id;
      $language_id      =   $request->language_id;
      $language_details =   Language::find($language_id);

      if(!empty($language_id)){
        $sms_languages = SmLanguage::find($id);
        $sms_languages->language_name= $language_details->name != null ? $language_details->name: '' ;
        $sms_languages->language_universal=  $language_details->code;
        $sms_languages->native=  $language_details->native;
        $sms_languages->lang_id=  $language_details->id;

        $results=$sms_languages->save();
          if($results){
            return redirect('language-settings')->with('message-success', 'Operation successful');
          }else{

            return redirect()->back()->with('message-danger', 'Ops! Something went wrong !');
          }

      }

  }




    public function languageAdd(Request $request){

      $request->validate([
          'lang_id' => 'required|unique:sm_languages|max:255', 
      ]);
     
 
      $lang_id=$request->lang_id;
      $language_details= DB::table('languages')->where('id',$lang_id)->first();

      if(!empty($language_details)){

        $sms_languages = new SmLanguage();
        $sms_languages->language_name= $language_details->name;
        $sms_languages->language_universal=  $language_details->code;
        $sms_languages->native=  $language_details->native;
        $sms_languages->lang_id=  $language_details->id;

        $results=$sms_languages->save();

        if($results){
          if(DB::statement('ALTER TABLE sm_language_phrases ADD '.$language_details->code.' text')){
            $column= $language_details->code;

            $all_translation_terms = SmLanguagePhrase::all();

            $jsonArr=[];
            foreach ($all_translation_terms  as $row) {
              $lid= $row->id;
              $english_term = $row->en;
              if(!empty($english_term)){
                $update_translation_term = SmLanguagePhrase::find($lid);
                $update_translation_term->$column=$english_term; 
                $update_translation_term->active_status =1;
                $update_translation_term->save();
              }

              //$jsonArr[$row->default_phrases]=$row->en;  //Don't Delete
            } 
            //$reGenarate = json_encode($jsonArr); //Don't Delete



            $path = base_path().'/resources/lang/'.$language_details->code;
            if(!file_exists($path)){
               File::makeDirectory($path, $mode = 0777, true, true);
               $newPath=$path.'lang.php';
               $page_content ="<?php 
               use App\SmLanguagePhrase; 
               \$getData = SmLanguagePhrase::where('active_status',1)->get(); 
               \$LanguageArr=[]; 
               foreach (\$getData as \$row) { 
                \$LanguageArr[\$row->default_phrases]=\$row->".$language_details->code."; 
              } 
              return \$LanguageArr;"; 
 

               if(!file_exists($newPath)){
                  File::put($path.'/lang.php',$page_content);
                }

              }
          
             return redirect('language-settings')->with('message-success', 'A new Language has been added successfully');
          }
          else{
           return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
         }

        }
        else{
           return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
         }
    } //not empty language
    
}



//backupSettings
    public function backupSettings(){
      $sms_dbs = SmBackup::orderBy('id', 'DESC')->get();
      return view('backEnd.systemSettings.backupSettings', compact('sms_dbs'));
    }


    

    public function BackupStore(Request $request){
      $request->validate([
            'content_file' => 'required|file|max:1024',
      ]);

      if($request->file('content_file') != ""){
         $file = $request->file('content_file');
         if($file->getClientOriginalExtension() =='sql'){
           $file_name ='Restore_'.date('d_m_Y_').$file->getClientOriginalName();
           $file->move('public/databaseBackup/', $file_name);
           $content_file = 'public/databaseBackup/'.$file_name;
         }else{
            return redirect()->back()->with('message-danger', 'Ops! Your file is not sql, please try again');
         }
      }

   
      if(isset($content_file)){
        $store = new SmBackup();
        $store->file_name =$file_name ;
        $store->source_link =$content_file  ;
        $store->active_status =1;
        $store->created_by =Auth::user()->id;
        $store->updated_by =Auth::user()->id;
        $result=$store->save();
      }
      if($result){
        return redirect()->back()->with('message-success-delete', 'Database deleted successfully');

      }else{
        return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
      }


      $sms_dbs = SmBackup::orderBy('id', 'DESC')->get();
      return view('backEnd.systemSettings.backupSettings', compact('sms_dbs'));
    }



    public function languageSetup($language_universal){
      $sms_languages = SmLanguagePhrase::where('active_status', 1)->get();
      $modules = SmModule::all();

      return view('backEnd.systemSettings.languageSetup', compact('language_universal','sms_languages','modules'));
    }

    


    public function deleteDatabase($id){
      $source_link="";
      $data = SmBackup::find($id);
      if(!empty($data)){
        $source_link=$data->source_link;
        if (file_exists($source_link)) {
          unlink($source_link);
        }
      }
      $result = SmBackup::where('id', $id)->delete();
      if($result){
        return redirect()->back()->with('message-success-delete', 'Database deleted successfully');
      }else{
        return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
      }
    }





 



  //download database from public/databaseBackup
    public function downloadDatabase($id){
      $source_link="";
      $data = SmBackup::where('id',$id)->first();
            if(!empty($data)){
        $source_link=$data->source_link;
        if (file_exists($source_link)) {
          unlink($source_link);
        }
      }

      if(file_exists($source_link)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="'.basename($source_link).'"');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($source_link));
          flush(); // Flush system output buffer
          readfile($source_link);
          return redirect()->back();
        }
    }

  //restore database from public/databaseBackup
    public function restoreDatabase($id){
      $sm_db = SmBackup::where('id',$id)->first();
      if(!empty($sm_db)){
        $source_link=$data->source_link;
      }

      
      $DB_HOST     = env("DB_HOST", "");
      $DB_DATABASE = env("DB_DATABASE", "");
      $DB_USERNAME = env("DB_USERNAME", "");
      $DB_PASSWORD = env("DB_PASSWORD", "");

      $connection  = mysqli_connect($DB_HOST ,$DB_USERNAME ,$DB_PASSWORD, $DB_DATABASE);      
  
      if (!file_exists($source_link)) {
        return redirect()->back()->with('message-danger', 'Your file is not found, please try again');

      }
      $handle = fopen($source_link,"r+");
      $contents = fread($handle,filesize($source_link));
      $sql = explode(';',$contents);
      $flag=0;
      foreach($sql as $query){
        $result = mysqli_query($connection,$query);
        if($result){
          $flag=1;
        }
      }
      fclose($handle);

      if($flag){
        return redirect()->back()->with('message-success', 'Database Restore successfully');
      }else{
        return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
      }
  }

    


//get files Backup #file
    public function getfilesBackup($id){ 
      if($id==1){
        $files = base_path().'/public/uploads'; 
        $created_file_name ='Backup_'.date('d_m_Y_h:i').'Images.zip';
      }else if($id==2){
        $files = base_path().'/public/uploads/'; 

        $created_file_name ='Backup_'.date('d_m_Y_h:i').'Projects.zip';
      }

 
        \Zipper::make(public_path($created_file_name))->add($files)->close();  

        $store = new SmBackup();
        $store->file_name =$created_file_name ;
        $store->source_link =public_path($created_file_name) ;
        $store->active_status =1;
        $store->file_type =$id;
        $store->created_by =Auth::user()->id;
        $store->updated_by =Auth::user()->id;
        $result=$store->save();
        if($id==2){ 
          return response()->download(public_path($created_file_name)); 
        }

      return redirect()->back()->with('message-success', 'Files Backup successfully');
    }


// download Files #file
  public function downloadFiles($id){
    $sm_db = SmBackup::where('id',$id)->first();
    $source_link=$sm_db->source_link; 
    return response()->download($source_link); 
  }





    public function getDatabaseBackup(){
      $DB_HOST     = env("DB_HOST", "");
      $DB_DATABASE = env("DB_DATABASE", "");
      $DB_USERNAME = env("DB_USERNAME", "");
      $DB_PASSWORD = env("DB_PASSWORD", "");
      $connection  = mysqli_connect($DB_HOST ,$DB_USERNAME ,$DB_PASSWORD, $DB_DATABASE);   

        $tables = array();
        $result = mysqli_query($connection,"SHOW TABLES");
        while($row = mysqli_fetch_row($result)){
          $tables[] = $row[0];
        }
        $return = '';
        foreach($tables as $table){
          $result = mysqli_query($connection,"SELECT * FROM ".$table);
          $num_fields = mysqli_num_fields($result);
          
          $return .= 'DROP TABLE '.$table.';';
          $row2 = mysqli_fetch_row(mysqli_query($connection,"SHOW CREATE TABLE ".$table));
          $return .= "\n\n".$row2[1].";\n\n";
          
          for($i=0;$i<$num_fields;$i++){
            while($row = mysqli_fetch_row($result)){
              $return .= "INSERT INTO ".$table." VALUES(";
              for($j=0;$j<$num_fields;$j++){
                $row[$j] = addslashes($row[$j]);
                if(isset($row[$j])){ $return .= '"'.$row[$j].'"';}
                else{ $return .= '""';}
                if($j<$num_fields-1){ $return .= ',';}
              }
              $return .= ");\n";
            }
          }
          $return .= "\n\n\n";
        }


        if (!file_exists('public/databaseBackup')) {
            mkdir('public/databaseBackup', 0777, true);
        }

        //save file 
        $name = 'database_backup_'.date('d_m_Y_h:i').'.sql';
        $path='public/databaseBackup/'.$name;
        $handle = fopen($path,"w+");
        fwrite($handle,$return);
        fclose($handle);

        $get_backup= new SmBackup();
        $get_backup->file_name= $name;
        $get_backup->source_link= $path;
        $get_backup->active_status =1;
        $get_backup->file_type =0;
        $results = $get_backup->save();

      // $sms_dbs = SmBackup::orderBy('id', 'DESC')->get();
      // return view('backEnd.systemSettings.backupSettings', compact('sms_dbs'));

      if($results){
      return redirect()->back()->with('message-success', 'Database Backup successfully');
      }else{
      return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
      }


    }






    public function updateClickatellData(){
    	$gateway_id = $_POST['gateway_id'];
    	$clickatell_username = $_POST['clickatell_username'];
    	$clickatell_password = $_POST['clickatell_password'];
    	$clickatell_api_id = $_POST['clickatell_api_id'];

    	if($gateway_id){
    		$gatewayDetails = SmSmsGateway::where('id', $gateway_id)->first();
    		if(!empty($gatewayDetails)){

    			$gatewayDetailss = SmSmsGateway::find($gatewayDetails->id);
               $gatewayDetailss->clickatell_username = $clickatell_username;
               $gatewayDetailss->clickatell_password = $clickatell_password;
               $gatewayDetailss->clickatell_api_id = $clickatell_api_id;
               $results = $gatewayDetailss->update();

           }
           else{

               $gatewayDetail = new SmSmsGateway();
               $gatewayDetail->clickatell_username = $clickatell_username;
               $gatewayDetail->clickatell_password = $clickatell_password;
               $gatewayDetail->clickatell_api_id = $clickatell_api_id;
               $results = $gatewayDetail->save();
           }
       }


       if($results){
           echo "success";
       }
   }





   public function updateTwilioData(){

     $gateway_id = $_POST['gateway_id'];
     $twilio_account_sid = $_POST['twilio_account_sid'];
     $twilio_authentication_token = $_POST['twilio_authentication_token'];
     $twilio_registered_no = $_POST['twilio_registered_no'];

     if($gateway_id){
      $gatewayDetails = SmSmsGateway::where('id', $gateway_id)->first();
      if(!empty($gatewayDetails)){

       $gatewayDetailss = SmSmsGateway::find($gatewayDetails->id);
       $gatewayDetailss->twilio_account_sid = $twilio_account_sid;
       $gatewayDetailss->twilio_authentication_token = $twilio_authentication_token;
       $gatewayDetailss->twilio_registered_no = $twilio_registered_no;
       $results = $gatewayDetailss->update();

   }
   else{

       $gatewayDetail = new SmSmsGateway();
       $gatewayDetail->twilio_account_sid = $twilio_account_sid;
       $gatewayDetail->twilio_authentication_token = $twilio_authentication_token;
       $gatewayDetail->twilio_registered_no = $twilio_registered_no;
       $results = $gatewayDetail->save();
   }
}


if($results){
   echo "success";
}
}

public function updateMsg91Data(){
  $gateway_id = $_POST['gateway_id'];
  $msg91_authentication_key_sid = $_POST['msg91_authentication_key_sid'];
  $msg91_sender_id = $_POST['msg91_sender_id'];
  $msg91_route = $_POST['msg91_route'];
  $msg91_country_code = $_POST['msg91_country_code'];

  if($gateway_id){
      $gatewayDetails = SmSmsGateway::where('id', $gateway_id)->first();
      if(!empty($gatewayDetails)){

       $gatewayDetailss = SmSmsGateway::find($gatewayDetails->id);
       $gatewayDetailss->msg91_authentication_key_sid = $msg91_authentication_key_sid;
       $gatewayDetailss->msg91_sender_id = $msg91_sender_id;
       $gatewayDetailss->msg91_route = $msg91_route;
       $gatewayDetailss->msg91_country_code = $msg91_country_code;
       $results = $gatewayDetailss->update();

   }
   else{

       $gatewayDetail = new SmSmsGateway();
       $gatewayDetail->msg91_authentication_key_sid = $msg91_authentication_key_sid;
       $gatewayDetail->msg91_sender_id = $msg91_sender_id;
       $gatewayDetail->msg91_route = $msg91_route;
       $gatewayDetail->msg91_country_code = $msg91_country_code;
       $results = $gatewayDetail->save();
   }
}


if($results){
   echo "success";
}
}

  public function activeSmsService(){
    $sms_service = $_POST['sms_service'];

    if($sms_service){
     $gatewayDetailss = SmSmsGateway::where('active_status', '=', 1)
     ->update(['active_status' => 0]);
  }

  $gatewayDetails = SmSmsGateway::find($sms_service);
  $gatewayDetails->active_status = 1;
  $results = $gatewayDetails->update();

  if($results){
     echo "success";
  }

}

public function generalSettingsView(Request $request){
  $editData = SmGeneralSettings::find(1);

    if (ApiBaseMethod::checkUrl($request->fullUrl())) {

        return ApiBaseMethod::sendResponse($editData, null);
    }
  return view('backEnd.systemSettings.generalSettingsView', compact('editData'));
}



public function updateGeneralSettings(Request $request){
  $editData = SmGeneralSettings::find(1);
  $session_ids = SmSession::where('active_status', 1)->get();
  $dateFormats = SmDateFormat::where('active_status', 1)->get();
  $languages = SmLanguage::all();
  $countries = SmCountry::select('currency')->groupBy('currency')->get();
  $currencies = SmCurrency::all();

    if(ApiBaseMethod::checkUrl($request->fullUrl())){
        $data = [];
        $data['editData'] = $editData;
        $data['session_ids'] = $session_ids->toArray();
        $data['dateFormats'] = $dateFormats->toArray();
        $data['languages'] = $languages->toArray();
        $data['countries'] = $countries->toArray();
        $data['currencies'] = $currencies->toArray();
        return ApiBaseMethod::sendResponse($data, 'apply leave');
    }
  return view('backEnd.systemSettings.updateGeneralSettings', compact('editData','session_ids', 'dateFormats', 'languages','countries','currencies'));
}

public function updateGeneralSettingsData(Request $request){

    $input = $request->all();

    $validator = Validator::make($input, [
    'school_name' => "required",
    'site_title' => "required",
    'phone' => "required",
    'email' => "required",
    'session_id'=> "required",
    'language_id'=> "required",
    'date_format_id'=> "required",
    'currency'=> "required",
    'currency_symbol'=> "required",

    ]);

    if ($validator->fails()) {
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
        }
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

  $id = 1;
  $generalSettData = SmGeneralSettings::find($id);
  $generalSettData->school_name = $request->school_name;
  $generalSettData->site_title = $request->site_title;
  $generalSettData->school_code = $request->school_code;
  $generalSettData->address = $request->address;
  $generalSettData->phone = $request->phone;
  $generalSettData->email = $request->email;
  $generalSettData->session_id = $request->session_id;
  $generalSettData->language_id = $request->language_id;
  $generalSettData->date_format_id = $request->date_format_id;
  $generalSettData->currency = $request->currency;
  $generalSettData->currency_symbol = $request->currency_symbol;

  $generalSettData->copyright_text = $request->copyright_text;
  
  $results = $generalSettData->update();

    if (ApiBaseMethod::checkUrl($request->fullUrl())) {
        if ($results) {
            return ApiBaseMethod::sendResponse(null, 'General Settings has been updated successfully');
        } else {
            return ApiBaseMethod::sendError('Something went wrong, please try again');
        }
    } else {
        if ($results) {
            return redirect('general-settings')->with('message-success', 'General Settings has been updated successfully');
        } else {
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }
    }
  }

public function updateSchoolLogo(Request $request){

		 // for upload School Logo
    if($request->file('main_school_logo') != ""){
       $main_school_logo = ""; 
       $file = $request->file('main_school_logo');
       $main_school_logo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
       $file->move('public/uploads/settings/', $main_school_logo);
       $main_school_logo = 'public/uploads/settings/'.$main_school_logo;
       $generalSettData = SmGeneralSettings::find(1);
       $generalSettData->logo = $main_school_logo;
        $results = $generalSettData->update();
   }
     // for upload School favicon
   else if($request->file('main_school_favicon') != ""){
       $main_school_favicon = ""; 
       $file = $request->file('main_school_favicon');
       $main_school_favicon = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
       $file->move('public/uploads/settings/', $main_school_favicon);
       $main_school_favicon = 'public/uploads/settings/'.$main_school_favicon;
       $generalSettData = SmGeneralSettings::find(1);
       $generalSettData->favicon = $main_school_favicon;
       $results = $generalSettData->update();
   }else{
       if (ApiBaseMethod::checkUrl($request->fullUrl())) {
           return ApiBaseMethod::sendError('No change applied, please try again');
       }
    return redirect()->back()->with('message-danger', 'No change applied, please try again');
   } 
   if($results){
       if (ApiBaseMethod::checkUrl($request->fullUrl())) {
           return ApiBaseMethod::sendResponse(null, 'Logo has been updated successfully');
       }

    return redirect()->back()->with('message-success', 'Logo has been updated successfully');
  }else{
       if (ApiBaseMethod::checkUrl($request->fullUrl())) {
           return ApiBaseMethod::sendError('Something went wrong, please try again');
       }

   return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
  }
}

public function emailSettings(){
    $editData = SmEmailSetting::find(1);

    return view('backEnd.systemSettings.emailSettingsView', compact('editData'));
}

public function updateEmailSettingsData(Request $request){

    $request->validate([
        'email_engine_type' => "required",
        'from_name' => "required",
        'from_email' => "required",
        ]);


    $email_engine_type = $_POST['email_engine_type'];
    if($email_engine_type == 'smtp'){
        if($request->smtp_username == '' || $request->smtp_password == '' || $request->smtp_server == '' || $request->smtp_port == '' || $request->smtp_security == ''){
            return redirect()->back()->with('message-danger', 'All Field in Smtp Details Must Be filled Up');
        }
    }

    $emailSettingsData = SmEmailSetting::select('id')->where('active_status', 1)->first();

    if(!empty($emailSettingsData)){


        $emailSettData = SmEmailSetting::find(1);
        $emailSettData->email_engine_type = $email_engine_type;
        $emailSettData->from_name = $request->from_name;
        $emailSettData->from_email = $request->from_email;
        $emailSettData->smtp_username = $request->smtp_username;
        $emailSettData->smtp_password = $request->smtp_password;
        $emailSettData->smtp_server = $request->smtp_server;
        $emailSettData->smtp_port = $request->smtp_port;
        $emailSettData->smtp_security = $request->smtp_security;
        $results = $emailSettData->update(); 
    }

    if($results){
        return redirect()->back()->with('message-success', 'Email Settings has been updated successfully');
    }else{
        return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
    }
 }

 public function paymentMethodSettings(){

    $payment_gateways = SmPaymentGatewaySetting::all();
    $paymentMethods = SmPaymentMethhod::where('id','!=', 1)->where('id','!=', 2)->where('id','!=', 3)->get();
    $activepaymentGateway = SmPaymentGatewaySetting::find(1);

     return view('backEnd.systemSettings.paymentMethodSettings', compact('paymentMethods', 'payment_gateways', 'activepaymentGateway'));
 
 }




 public function updatePaypalData(){
      $gateway_id = $_POST['gateway_id'];
      $paypal_username = $_POST['paypal_username'];
      $paypal_password = $_POST['paypal_password'];
      $paypal_signature = $_POST['paypal_signature'];
      $paypal_client_id = $_POST['paypal_client_id'];
      $paypal_secret_id = $_POST['paypal_secret_id'];

      if($gateway_id){
        $gatewayDetails = SmPaymentGatewaySetting::where('id', $gateway_id)->first();
        if(!empty($gatewayDetails)){

          $gatewayDetailss = SmPaymentGatewaySetting::find($gatewayDetails->id);
               $gatewayDetailss->paypal_username = $paypal_username;
               $gatewayDetailss->paypal_password = $paypal_password;
               $gatewayDetailss->paypal_signature = $paypal_signature;
               $gatewayDetailss->paypal_client_id = $paypal_client_id;
               $gatewayDetailss->paypal_secret_id = $paypal_secret_id;
               $results = $gatewayDetailss->update();

           }
           else{

               $gatewayDetail = new SmPaymentGatewaySetting();
               $gatewayDetail->paypal_username = $paypal_username;
               $gatewayDetail->paypal_password = $paypal_password;
               $gatewayDetail->paypal_signature = $paypal_signature;
               $gatewayDetail->paypal_client_id = $paypal_client_id;
               $gatewayDetail->paypal_secret_id = $paypal_secret_id;
               $results = $gatewayDetail->save();
           }
       }


       if($results){
           echo "success";
       }
 }

 public function updateStripeData(){
      $gateway_id = $_POST['gateway_id'];
      $stripe_api_secret_key = $_POST['stripe_api_secret_key'];
      $stripe_publisher_key = $_POST['stripe_publisher_key'];
     
      if($gateway_id){
        $gatewayDetails = SmPaymentGatewaySetting::where('id', $gateway_id)->first();
        if(!empty($gatewayDetails)){

          $gatewayDetailss = SmPaymentGatewaySetting::find($gatewayDetails->id);
               $gatewayDetailss->stripe_api_secret_key = $stripe_api_secret_key;
               $gatewayDetailss->stripe_publisher_key = $stripe_publisher_key;
               $results = $gatewayDetailss->update();

           }
           else{

               $gatewayDetail = new SmPaymentGatewaySetting();
               $gatewayDetail->stripe_api_secret_key = $stripe_api_secret_key;
               $gatewayDetail->stripe_publisher_key = $stripe_publisher_key;
               $results = $gatewayDetail->save();
           }
       }

       if($results){
           echo "success";
       }
    }

    public function updatePayumoneyData(){
          $gateway_id = $_POST['gateway_id'];
          $pay_u_money_key = $_POST['pay_u_money_key'];
          $pay_u_money_salt = $_POST['pay_u_money_salt'];
         
          if($gateway_id){
            $gatewayDetails = SmPaymentGatewaySetting::where('id', $gateway_id)->first();
            if(!empty($gatewayDetails)){

              $gatewayDetailss = SmPaymentGatewaySetting::find($gatewayDetails->id);
                   $gatewayDetailss->pay_u_money_key = $pay_u_money_key;
                   $gatewayDetailss->pay_u_money_salt = $pay_u_money_salt;
                   $results = $gatewayDetailss->update();

               }
               else{

                   $gatewayDetail = new SmPaymentGatewaySetting();
                   $gatewayDetail->pay_u_money_key = $pay_u_money_key;
                   $gatewayDetail->pay_u_money_salt = $pay_u_money_salt;
                   $results = $gatewayDetail->save();
               }
           }

           if($results){
               echo "success";
           }
        }

        public function activePaymentGateway(){
          $gateway_id = $_POST['gateway_id'];

          if($gateway_id){
           $gatewayDetailss = SmPaymentGatewaySetting::where('active_status', '=', 1)
           ->update(['active_status' => 0]);
          }

           $results = SmPaymentGatewaySetting::where('gateway_name', '=', $gateway_id)
           ->update(['active_status' => 1]);

         if($results){
           echo "success";
          }
       }


       public function languageDelete(Request $request){

        $delete_directory=SmLanguage::find($request->id);

        DB::beginTransaction();

        try{

          if(DB::statement('ALTER TABLE sm_language_phrases DROP COLUMN '.$delete_directory->language_universal)){
            if($delete_directory){
              $path = base_path().'/resources/lang/'.$delete_directory->language_universal;
              if(file_exists($path)){
                File::delete($path.'/lang.php');
                rmdir( $path );
              }
              $result = SmLanguage::destroy($request->id);
               if($result) {
                   return redirect()->back()->with('message-success-delete', 'Language has been deleted successfully');
               }

          }else{
              return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
          }

       } //end drop table column 

       DB::commit();
      return redirect()->back()->with('message-success-delete', 'Language has been deleted successfully');

            }catch(Exception $e){
                DB::rollBack();
            }


}


       public function changeLocale($locale)
       {
          Session::put('locale',$locale);
          return redirect()->back();
       }

       public function changeLanguage($id)
       {
            SmLanguage::where('active_status', '=', 1)->update(['active_status' => 0]);
            $language=SmLanguage::find($id);
            $language->active_status=1;
            $language->save();
            Session::flash('langChange','Successfully Language Changed');
            return redirect()->to('locale/'.$language->language_universal);
       }

       public function getTranslationTerms(Request $request){
          $terms = SmLanguagePhrase::where('modules', $request->id)->get();
          return response()->json($terms);
       }


       public function translationTermUpdate(Request $request){
       // dd($request->input());
        $InputId= $request->InputId;
        $language_universal= $request->language_universal;
        $LU= $request->LU;

        foreach ($InputId as $id) {
          $data = SmLanguagePhrase::find($id);
          $data->$language_universal = $LU[$id];
          $data->save();
        }
        return redirect()->back()->with('message-success', 'Updated Successfully');
       }


//Update System is Availalbe

    public   function recurse_copy($src,$dst) { 
            $dir = opendir($src); 
            @mkdir($dst); 
            while(false !== ( $file = readdir($dir)) ) { 
                if (( $file != '.' ) && ( $file != '..' )) { 
                    if ( is_dir($src . '/' . $file) ) { 
                        $this->recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                    } 
                    else { 
                        copy($src . '/' . $file,$dst . '/' . $file); 
                    } 
                } 
            } 
            closedir($dir); 
        } 

        //Update System
       public function UpdateSystem(){
        $is_update = \DB::connection('mysql2')->select("SELECT * FROM versions ORDER BY ID DESC limit 1");
        $version_number = $is_update[0]->version;
        $versions=  \DB::connection('mysql2')->select("SELECT * FROM system_upgrade where version=$version_number"); 
        $existing = SmGeneralSettings::find(1);
        return view('backEnd.systemSettings.updateSettings', compact('is_update', 'existing','versions','version_number'));
       }

 

       public function UpgradeSettings(Request $request){
        // $version = $request->version;
        // $versions_data=  \DB::connection('mysql2')->select("SELECT * FROM system_upgrade where version=$version");
        

                $ftp_server = '139.59.17.19';
                $port = 21;
                $ftp_username = 'rashed';
                $ftp_userpass = '@midhaka1N@!'; 

                $ftp_conn = ftp_ssl_connect($ftp_server) or die("Could not connect to $ftp_server");
                $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
                $filelist = ftp_nlist($ftp_conn, "."); 

              // if(copy($src, $dst)){ 
                $update = SmGeneralSettings::find(1);
                $update->system_version = $version;
                $update->save();
              // }

 


        // return response()->download($dst );
       return redirect()->back()->with('message-success', 'Upgrade Successfully'); 
       }
       
    public function ajaxSelectCurrency(Request $request){

        $select_currency_symbol = SmCurrency::select('symbol')->where('code', '=', $request->id)->first();

        $currency_symbol['symbol'] =$select_currency_symbol->symbol;


        return response()->json([$currency_symbol]);
    }




  }



