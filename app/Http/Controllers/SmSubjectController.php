<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmSubject;
use Validator;

class SmSubjectController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    public function index(Request $request){
    	$subjects = SmSubject::where('active_status', 1)->orderBy('id', 'DESC')->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($subjects, null);
        }
    	return view('backEnd.academics.subject', compact('subjects'));

    }
    public function store(Request $request){
        $input = $request->all();
        if(ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'subject_name' => "required|unique:sm_subjects",
                'subject_type' => "required",
            ]);
        }else{
            $validator = Validator::make($input, [
                'subject_name' => "required|unique:sm_subjects"
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
    	$subject = new SmSubject();
    	$subject->subject_name = $request->subject_name;
    	$subject->subject_type = $request->subject_type;
    	$subject->subject_code = $request->subject_code;
    	$result = $subject->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Subject has been created successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect()->back()->with('message-success', 'Subject has been created successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function edit(Request $request,$id){
    	$subject = SmSubject::find($id);
    	$subjects = SmSubject::where('active_status', 1)->orderBy('id', 'DESC')->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['subject']= $subject->toArray();
            $data['subjects']= $subjects->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
     	return view('backEnd.academics.subject', compact('subject', 'subjects'));
    }
    public function update(Request $request){
        $input = $request->all();
        if(ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'subject_name' => "required|unique:sm_subjects",
                'subject_type' => "required",
            ]);
        }else{
            $validator = Validator::make($input, [
                'subject_name' => "required|unique:sm_subjects"
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

    	$subject = SmSubject::find($request->id);
    	$subject->subject_name = $request->subject_name;
    	$subject->subject_type = $request->subject_type;
    	$subject->subject_code = $request->subject_code;
    	$result = $subject->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Subject has been updated successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect()->back()->with('message-success', 'Subject has been updated successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }

    }
    public function delete(Request $request,$id){
    	$subject = SmSubject::destroy($id);

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($subject){
                return ApiBaseMethod::sendResponse(null, 'Subject has been deleted successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($subject){
                return redirect()->back()->with('message-success-delete', 'Subject has been deleted successfully');
            }else{
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }
}
