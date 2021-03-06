<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmStudentGroup;
use Validator;

class SmStudentGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }
    
    public function index(Request $request){
    	$student_groups = SmStudentGroup::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($student_groups, null);
        }

    	return view('backEnd.studentInformation.student_group', compact('student_groups'));

    }
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'group' => 'required|unique:sm_student_groups,group',
    	]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

    	$student_group = new SmStudentGroup();
    	$student_group->group = $request->group;
    	$result = $student_group->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Group been created successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                return redirect()->back()->with('message-success', 'Group been created successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }

    public function edit(Request $request,$id){
    	$student_group = SmStudentGroup::find($id);
    	$student_groups = SmStudentGroup::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['student_group'] = $student_group->toArray();
            $data['student_groups'] = $student_groups->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
     	return view('backEnd.studentInformation.student_group', compact('student_groups', 'student_group'));
    }
    public function update(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'group' => 'required|unique:sm_student_groups,group,'.$request->id,
    	]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    	
    	$student_group = SmStudentGroup::find($request->id);
    	$student_group->group = $request->group;
    	$result = $student_group->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Group been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                return redirect('student-group')->with('message-success', 'Group been updated successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function delete(Request $request, $id){
    	$student_group = SmStudentGroup::destroy($id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($student_group) {
                return ApiBaseMethod::sendResponse(null, 'Group has been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($student_group) {
                return redirect()->back()->with('message-success-delete', 'Group has been deleted successfully');
            } else {
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }
}
