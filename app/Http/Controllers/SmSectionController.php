<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmSection;
use Validator;
class SmSectionController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    public function index(Request $request){
    	$sections = SmSection::where('active_status', '=', 1)->get();
        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($sections, null);
        }

    	return view('backEnd.academics.section', compact('sections'));

    }
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'name' => "required|unique:sm_sections,section_name"
    	]);
        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

    	$section = new SmSection();
    	$section->section_name = $request->name;
    	$result = $section->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Section has been created successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect()->back()->with('message-success', 'Section has been created successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function edit(Request $request,$id){
    	$section = SmSection::find($id);
    	$sections = SmSection::where('active_status', '=', 1)->orderBy('id', 'desc')->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['section']= $section->toArray();
            $data['sections']= $sections->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

     	return view('backEnd.academics.section', compact('section', 'sections'));
    }
    public function update(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'name' => "required|unique:sm_sections,section_name,".$request->id
    	]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    	$section = SmSection::find($request->id);
    	$section->section_name = $request->name;
    	$result = $section->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Section has been updated successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect('section')->with('message-success', 'Section has been updated successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function delete(Request $request,$id){
    	$section = SmSection::destroy($id);

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($section){
                return ApiBaseMethod::sendResponse(null, 'Section has been deleted successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($section){
                return redirect()->back()->with('message-success-delete', 'Section has been deleted successfully');
            }else{
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }
}
