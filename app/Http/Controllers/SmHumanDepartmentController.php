<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmHumanDepartment;
use PhpMyAdmin\MoTranslator\ReaderException;
use Validator;

class SmHumanDepartmentController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = SmHumanDepartment::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($departments, null);
        }

        return view('backEnd.humanResource.human_resource_department', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => "required"
        ]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $department = new SmHumanDepartment();
        $department->name = $request->name;
        $result = $department->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Department has been created successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect()->back()->with('message-success', 'Department has been created successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $department = SmHumanDepartment::find($id);
        $departments = SmHumanDepartment::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['department']= $department->toArray();
            $data['departments']= $departments->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.humanResource.human_resource_department', compact('department', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => "required"
        ]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $department = SmHumanDepartment::find($request->id);
        $department->name = $request->name;
        $result = $department->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Department has been updated successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect('department')->with('message-success', 'Department has been updated successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $department = SmHumanDepartment::destroy($id);

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($department){
                return ApiBaseMethod::sendResponse(null, 'Department has been deleted successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($department){
                return redirect('department')->with('message-success-delete', 'Department has been deleted successfully');
            }else{
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }
}
