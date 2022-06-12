<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use App\Role;
use App\SmClass;
use App\SmNoticeBoard;
use App\SmParent;
use App\SmSmsGateway;
use App\SmStaff;
use App\SmStudent;
use Illuminate\Http\Request;
use Mail;
use PhpMyAdmin\MoTranslator\ReaderException;
use Twilio;
use Clickatell\Rest;
use Clickatell\ClickatellException;
use App\SmEmailSmsLog;
use Validator;

class SmCommunicateController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    
    public function sendMessage(Request $request)
    {
        $roles = Role::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($roles, null);
        }
        return view('backEnd.communicate.sendMessage', compact('roles'));
    }

    public function saveNoticeData(Request $request)
    {
        $input = $request->all();
        if(ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'notice_title' => "required",
                'notice_date' => "required",
                'publish_on' => "required",
                'login_id' => "required"
            ]);
        }else{
            $validator = Validator::make($input, [
                'notice_title' => "required",
                'notice_date' => "required",
                'publish_on' => "required",
            ]);
        }

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $roles_array = array();
        if (empty($request->role)) {
            $roles_array = '';
        } else {
            $roles_array = implode(',', $request->role);
        }

        $user = Auth()->user();

        if($user){
            $login_id=$user->id;

        }
        else{
            $login_id=$request->login_id;
        }

        $noticeData = new SmNoticeBoard();
        $noticeData->notice_title = $request->notice_title;
        $noticeData->notice_message = $request->notice_message;
        $noticeData->notice_date = date('Y-m-d', strtotime($request->notice_date));
        $noticeData->publish_on = date('Y-m-d', strtotime($request->publish_on));
        $noticeData->inform_to = $roles_array;
        $noticeData->created_by = $login_id;
        $results = $noticeData->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($results){
                return ApiBaseMethod::sendResponse(null, 'Class Room has been created successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($results){
                return redirect()->back()->with('message-success', 'New Notice has been added successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }

    }

    public function noticeList(Request $request)
    {
        $allNotices = SmNoticeBoard::where('active_status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($allNotices, null);
        }

        return view('backEnd.communicate.noticeList', compact('allNotices'));
    }

    public function editNotice(Request $request, $notice_id)
    {
        $roles = Role::all();
        $noticeDataDetails = SmNoticeBoard::find($notice_id);

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['roles']= $roles->toArray();
            $data['noticeDataDetails']= $noticeDataDetails->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.communicate.editSendMessage', compact('noticeDataDetails', 'roles'));

    }

    public function updateNoticeData(Request $request)
    {
        $input = $request->all();
        if(ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'notice_title' => "required",
                'notice_date' => "required",
                'publish_on' => "required",
                'login_id' => "required"
            ]);
        }else{
            $validator = Validator::make($input, [
                'notice_title' => "required",
                'notice_date' => "required",
                'publish_on' => "required",
            ]);
        }

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $roles_array = array();
        if (empty($request->role)) {
            $roles_array = '';
        } else {
            $roles_array = implode(',', $request->role);
        }

        $user = Auth()->user();

        if($user){
            $login_id=$user->id;

        }
        else{
            $login_id=$request->login_id;
        }

        $noticeData = SmNoticeBoard::find($request->notice_id);
        $noticeData->notice_title = $request->notice_title;
        $noticeData->notice_message = $request->notice_message;
        $noticeData->notice_date = date('Y-m-d', strtotime($request->notice_date));
        $noticeData->publish_on = date('Y-m-d', strtotime($request->publish_on));
        $noticeData->inform_to = $roles_array;
        $noticeData->updated_by = $login_id;
        $results = $noticeData->update();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($results){
                return ApiBaseMethod::sendResponse(null, 'Notice has been updated successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        }else{
            if($results){
                return redirect('notice-list')->with('message-success-delete', 'Notice has been updated successfully');
            }else{
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }

    }

    public function deleteNoticeView(Request $request,$id)
    {
        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($id, null);
        }
        return view('backEnd.communicate.deleteNoticeView', compact('id'));
    }

    public function deleteNotice(Request $request,$id)
    {
        $result = SmNoticeBoard::destroy($id);

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Notice has been deleted successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect()->back()->with('message-success-delete', 'Notice has been deleted successfully');
            }else{
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }

    public function sendEmailSmsView(Request $request)
    {
        $roles = Role::select('*')->where('id', '!=', 1)->get();
        $classes = SmClass::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['roles']= $roles->toArray();
            $data['classes']= $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.communicate.sendEmailSms', compact('roles', 'classes'));
    }

    public function sendEmailSms(Request $request)
    {

        $request->validate([
            'email_sms_title' => "required",
            'send_through' => "required",
            'description' => "required",
        ]);

        // save data in email sms log
        $saveEmailSmsLogData = new SmEmailSmsLog();
        $saveEmailSmsLogData->saveEmailSmsLogData($request);

        if (empty($request->selectTab) or $request->selectTab == 'G') {
            
            if (empty($request->role)) {
                return redirect()->back()->with('message-danger', 'Please select whom you want to send');
            } else {

                $email_sms_title = $request->email_sms_title;
                $description = $request->description;
                $message_to = implode(',', $request->role);

                $to_name = '';
                $to_email = '';
                $to_mobile = '';
                $receiverDetails = '';

                foreach ($request->role as $key => $value) {
                    if ($value == 2) {
                        $receiverDetails = SmStudent::select('email', 'full_name', 'mobile')->where('active_status', 1)->get();
                        if (!empty($receiverDetails)) {
                            foreach ($receiverDetails as $receiverDetail) {
                                $to_name = $receiverDetail->full_name;
                                $to_email = $receiverDetail->email;
                                $to_mobile = "+88" . $receiverDetail->mobile;
                                // send dynamic content in $data
                                $data = array(
                                    'name' => $to_name,
                                    'email_sms_title' => $request->email_sms_title,
                                    'description' => $request->description,
                                );

                                if ($request->send_through == 'E') {
                                    if (!empty($receiverDetail->full_name) && !empty($receiverDetail->email)) {
                                    Mail::send('backEnd.emails.mail', ["result" => $data], function ($message) use ($to_name, $to_email) {
                                        $message->to($to_email, $to_name)
                                            ->subject('New Email');
                                        $message->from('info@support.com', 'School Management');
                                    });
                                  }
                                } else {
                                    // check active sms gateway
                                    $activeSmsGateway = SmSmsGateway::select('gateway_name')->where('active_status', '=', 1)->first();
                                    if ($activeSmsGateway->gateway_name == 'Twilio') {
                                        $smsGatewayDetails = SmSmsGateway::select('*')
                                            ->where('gateway_name', '=', 'Twilio')->first();
                                        $account_id = $smsGatewayDetails->twilio_account_sid; // Your Account SID from www.twilio.com/console
                                        $auth_token = $smsGatewayDetails->twilio_authentication_token; // Your Auth Token from www.twilio.com/console
                                        $from_phone_number = $smsGatewayDetails->twilio_registered_no;
                                        $client = new Twilio\Rest\Client($account_id, $auth_token);

                                        if(!empty($to_mobile)){
                                            $message = $client->messages->create(
                                            $to_mobile, // Text this number
                                            array(
                                                'from' => $from_phone_number, // From a valid Twilio number
                                                'body' => $request->description
                                                )
                                            );
                                        }
                                        //print $message->sid;
                                    }
                                    if($activeSmsGateway->gateway_name == 'Clickatell'){

                                        $smsGatewayDetails = SmSmsGateway::select('*')
                                            ->where('gateway_name', '=', 'Clickatell')->first();
                                        config(['clickatell.api_key' => $smsGatewayDetails->clickatell_api_id]); //set a variale in config file(clickatell.php)
                                          $clickatell = new \Clickatell\Rest();
                                       
                                          $result = $clickatell->sendMessage([
                                            'to' => [$to_mobile], 
                                            'content' => $request->description
                                          ]);
                                      }
                                }

                            }
                        }
                    }
                    if ($value == 3) {
                        $receiverDetails = SmParent::select('guardians_email', 'fathers_name', 'fathers_mobile')->get();

                        if (!empty($receiverDetails)) {
                            foreach ($receiverDetails as $receiverDetail) {
                                $to_name = $receiverDetail->fathers_name;
                                $to_email = $receiverDetail->guardians_email;
                                $to_mobile = "+88" .$receiverDetail->fathers_mobile;
                                // send dynamic content in $data
                                $data = array(
                                    'name' => $to_name,
                                    'email_sms_title' => $request->email_sms_title,
                                    'description' => $request->description,
                                );

                                if ($request->send_through == 'E') {
                                    if (!empty($receiverDetail->fathers_name) && !empty($receiverDetail->guardians_email)) {
                                    Mail::send('backEnd.emails.mail', ["result" => $data], function ($message) use ($to_name, $to_email) {
                                        $message->to($to_email, $to_name)
                                            ->subject('New Email');
                                        $message->from('info@support.com', 'School Management');
                                    });
                                  }
                                } else {
                                    // check active sms gateway
                                    $activeSmsGateway = SmSmsGateway::select('gateway_name')->where('active_status', '=', 1)->first();
                                    if ($activeSmsGateway->gateway_name == 'Twilio') {
                                        $smsGatewayDetails = SmSmsGateway::select('*')
                                            ->where('gateway_name', '=', 'Twilio')->first();
                                        $account_id = $smsGatewayDetails->twilio_account_sid; // Your Account SID from www.twilio.com/console
                                        $auth_token = $smsGatewayDetails->twilio_authentication_token; // Your Auth Token from www.twilio.com/console
                                        $from_phone_number = $smsGatewayDetails->twilio_registered_no;
                                        $client = new Twilio\Rest\Client($account_id, $auth_token);

                                        $message = $client->messages->create(
                                            $to_mobile, // Text this number
                                            array(
                                                'from' => $from_phone_number, // From a valid Twilio number
                                                'body' => $request->description
                                                )
                                        );

                                        //print $message->sid;
                                    }

                                    if($activeSmsGateway->gateway_name == 'Clickatell'){

                                        $smsGatewayDetails = SmSmsGateway::select('*')
                                            ->where('gateway_name', '=', 'Clickatell')->first();
                                        config(['clickatell.api_key' => $smsGatewayDetails->clickatell_api_id]); //set a variale in config file(clickatell.php)
                                          $clickatell = new \Clickatell\Rest();
                                       
                                          $result = $clickatell->sendMessage([
                                            'to' => [$to_mobile], 
                                            'content' => $request->description
                                          ]);
                                      }
                                }

                            }
                        }

                    }
                    if ($value != 2 and $value != 3) {

                        $receiverDetails = SmStaff::select('email', 'full_name', 'mobile')->where('role_id', $value)->
                            where('active_status', 1)->get();

                        if (!empty($receiverDetails)) {
                            foreach ($receiverDetails as $receiverDetail) {
                                $to_name = $receiverDetail->full_name;
                                $to_email = $receiverDetail->email;
                                $to_mobile = "+88" .$receiverDetail->mobile;
                                // send dynamic content in $data
                                $data = array(
                                    'name' => $to_name,
                                    'email_sms_title' => $request->email_sms_title,
                                    'description' => $request->description,
                                );

                                if ($request->send_through == 'E') {
                                    if (!empty($receiverDetail->full_name) && !empty($receiverDetail->email)) {
                                    Mail::send('backEnd.emails.mail', ["result" => $data], function ($message) use ($to_name, $to_email) {
                                        $message->to($to_email, $to_name)
                                            ->subject('New Email');
                                        $message->from('info@support.com', 'School Management');
                                    });
                                  }
                                } else {
                                    // check active sms gateway
                                    $activeSmsGateway = SmSmsGateway::select('gateway_name')->where('active_status', '=', 1)->first();
                                    if ($activeSmsGateway->gateway_name == 'Twilio') {
                                        $smsGatewayDetails = SmSmsGateway::select('*')
                                            ->where('gateway_name', '=', 'Twilio')->first();
                                        $account_id = $smsGatewayDetails->twilio_account_sid; // Your Account SID from www.twilio.com/console
                                        $auth_token = $smsGatewayDetails->twilio_authentication_token; // Your Auth Token from www.twilio.com/console
                                        $from_phone_number = $smsGatewayDetails->twilio_registered_no;
                                        $client = new Twilio\Rest\Client($account_id, $auth_token);

                                        $message = $client->messages->create(
                                            $to_mobile, // Text this number
                                            array(
                                                'from' => $from_phone_number, // From a valid Twilio number
                                                'body' => $request->description
                                                )
                                        );

                                        //print $message->sid;
                                    }

                                    if($activeSmsGateway->gateway_name == 'Clickatell'){

                                        $smsGatewayDetails = SmSmsGateway::select('*')
                                            ->where('gateway_name', '=', 'Clickatell')->first();
                                        config(['clickatell.api_key' => $smsGatewayDetails->clickatell_api_id]); //set a variale in config file(clickatell.php)
                                          $clickatell = new \Clickatell\Rest();
                                       
                                          $result = $clickatell->sendMessage([
                                            'to' => [$to_mobile], 
                                            'content' => $request->description
                                          ]);
                                      }
                                }

                            }
                        }
                    }

                } // end foreach loop
                return redirect()->back()->with('message-success', 'Successfully Sent');
            } // end else
        } elseif ($request->selectTab == 'I') {
            if (empty($request->message_to_individual)) {
                return redirect()->back()->with('message-danger', 'Please select whom you want to send');
            } else {
                $message_to_individual = $request->message_to_individual;

                foreach ($message_to_individual as $key => $value) {
                    $receiver_full_name_email = explode('-', $value);
                    $receiver_full_name = $receiver_full_name_email[0];
                    $receiver_email = $receiver_full_name_email[1];
                    $receiver_mobile = $receiver_full_name_email[2];

                    $to_name = $receiver_full_name;
                    $to_email = $receiver_email;
                    $to_mobile = "+88".$receiver_mobile;
                    // send dynamic content in $data
                    $data = array(
                        'name' => $to_name,
                        'email_sms_title' => $request->email_sms_title,
                        'description' => $request->description,
                    );
                    // If checked Email
                    if ($request->send_through == 'E') {
                        if (!empty($receiver_full_name) && !empty($receiver_email)) {
                            Mail::send('backEnd.emails.mail', ["result" => $data], function ($message) use ($to_name, $to_email) {
                            $message->to($to_email, $to_name)
                            ->subject('New Email');
                            $message->from('info@support.com', 'School Management');
                        });
                       }
                    }
                    // if checked Sms 
                    else {
                        $activeSmsGateway = SmSmsGateway::select('gateway_name')->where('active_status', '=', 1)->first();
                        if ($activeSmsGateway->gateway_name == 'Twilio') {
                            $smsGatewayDetails = SmSmsGateway::select('*')
                                ->where('gateway_name', '=', 'Twilio')->first();
                            $account_id = $smsGatewayDetails->twilio_account_sid; // Your Account SID from www.twilio.com/console
                            $auth_token = $smsGatewayDetails->twilio_authentication_token; // Your Auth Token from www.twilio.com/console
                            $from_phone_number = $smsGatewayDetails->twilio_registered_no;
                            $client = new Twilio\Rest\Client($account_id, $auth_token);

                            $message = $client->messages->create(
                                $to_mobile, // Text this number
                                array(
                                    'from' => $from_phone_number, // From a valid Twilio number
                                    'body' => $request->description
                                    )
                            );

                            //print $message->sid;
                        }

                        if($activeSmsGateway->gateway_name == 'Clickatell'){

                            $smsGatewayDetails = SmSmsGateway::select('*')
                                ->where('gateway_name', '=', 'Clickatell')->first();
                            config(['clickatell.api_key' => $smsGatewayDetails->clickatell_api_id]); //set a variale in config file(clickatell.php)
                              $clickatell = new \Clickatell\Rest();
                           
                              $result = $clickatell->sendMessage([
                                'to' => [$to_mobile], 
                                'content' => $request->description
                              ]);
                          }
                    }

                }
                return redirect()->back()->with('message-success', 'Successfully Sent');
            }

        } else {
            //  start send email/sms to class section
            if (empty($request->message_to_section)) {
                return redirect()->back()->with('message-danger', 'Please select whom you want to send');
            } else {
                $class_id = $request->class_id;
                $selectedSections = $request->message_to_section;
                foreach ($selectedSections as $key => $value) {
                    $students = SmStudent::select('email', 'full_name', 'mobile')->where('class_id', $class_id)->where('section_id', $value)->where('active_status', 1)->get();

                    foreach ($students as $student) {
                        $to_name = $student->full_name;
                        $to_email = $student->email;
                        $to_mobile = "+88".$student->mobile;
                        // send dynamic content in $data
                        $data = array(
                            'name' => $student->full_name,
                            'email_sms_title' => $request->email_sms_title,
                            'description' => $request->description,
                        );

                        if($request->send_through == 'E'){
                            if (!empty($student->full_name) && !empty($student->email)) {

                            Mail::send('backEnd.emails.mail', ["result" => $data], function ($message) use ($to_name, $to_email) {
                                $message->to($to_email, $to_name)
                                    ->subject('New Email');
                                $message->from('info@support.com', 'School Management');
                            });

                            }
                        }
                        else {
                        $activeSmsGateway = SmSmsGateway::select('gateway_name')->where('active_status', '=', 1)->first();
                        if ($activeSmsGateway->gateway_name == 'Twilio') {
                            $smsGatewayDetails = SmSmsGateway::select('*')
                                ->where('gateway_name', '=', 'Twilio')->first();
                            $account_id = $smsGatewayDetails->twilio_account_sid; // Your Account SID from www.twilio.com/console
                            $auth_token = $smsGatewayDetails->twilio_authentication_token; // Your Auth Token from www.twilio.com/console
                            $from_phone_number = $smsGatewayDetails->twilio_registered_no;
                            $client = new Twilio\Rest\Client($account_id, $auth_token);

                            $message = $client->messages->create(
                                $to_mobile, // Text this number
                                array(
                                    'from' => $from_phone_number, // From a valid Twilio number
                                    'body' => $request->description
                                    )
                            );

                            //print $message->sid;
                        }
                        if($activeSmsGateway->gateway_name == 'Clickatell'){

                            $smsGatewayDetails = SmSmsGateway::select('*')
                                ->where('gateway_name', '=', 'Clickatell')->first();
                            config(['clickatell.api_key' => $smsGatewayDetails->clickatell_api_id]); //set a variale in config file(clickatell.php)
                              $clickatell = new \Clickatell\Rest();
                           
                              $result = $clickatell->sendMessage([
                                'to' => [$to_mobile], 
                                'content' => $request->description
                              ]);
                          }
                       }
                    }
                }
                return redirect()->back()->with('message-success', 'Successfully Sent');
            }
        }

        

    } // end function sendEmailSms

    public function studStaffByRole(Request $request)
    {

        if ($request->id == 2) {
            $allStudents = SmStudent::where('active_status', '=', 1)->get();
            $students = [];
            foreach ($allStudents as $allStudent) {
                $students[] = SmStudent::find($allStudent->id);
            }

            return response()->json([$students]);
        }

        if ($request->id == 3) {
            $allParents = SmParent::all();
            $parents = [];
            foreach ($allParents as $allParent) {
                $parents[] = SmParent::find($allParent->id);
            }

            return response()->json([$parents]);
        }

        if ($request->id != 2 and $request->id != 3) {
            $allStaffs = SmStaff::where('role_id', '=', $request->id)->where('active_status', '=', 1)->get();
            $staffs = [];
            foreach ($allStaffs as $staffsvalue) {
                $staffs[] = SmStaff::find($staffsvalue->id);
            }

            return response()->json([$staffs]);
        }

    }

    public function emailSmsLog(){
        $emailSmsLogs = SmEmailSmsLog::orderBy('id', 'DESC')->get();
        return view('backEnd.communicate.emailSmsLog', compact('emailSmsLogs'));
    }

}
