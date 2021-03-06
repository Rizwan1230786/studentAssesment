<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmLeaveType;
use App\Role;
use App\SmLeaveDefine;
use Auth;
use Validator;

class SmLeaveDefineController extends Controller
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
        $leave_types = SmLeaveType::where('active_status', 1)->get();
        $roles = Role::where('active_status', 1)->get();
        $leave_defines = SmLeaveDefine::where('active_status', 1)->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){

            $data = [];
            $data['leave_types'] = $leave_types->toArray();
            $data['roles'] = $roles->toArray();
            $data['leave_defines'] = $leave_defines->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.humanResource.leave_define', compact('leave_types', 'holidays', 'roles', 'leave_defines'));
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
            'role' => "required",
            'leave_type' => 'required',
            'days' => 'required|numeric'
        ]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $leaves = SmLeaveDefine::where('role_id', $request->role)->where('type_id', $request->leave_type)->first();

        if($leaves == ""){
            $leave_define = new SmLeaveDefine();
            $leave_define->role_id = $request->role;
            $leave_define->type_id = $request->leave_type;
            $leave_define->days = $request->days;
            $results = $leave_define->save();

            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                if($results){
                    return ApiBaseMethod::sendResponse(null, 'Visitor has been created successfully.');
                }
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }else{
                if($results){
                    return redirect()->back()->with('message-success', 'Leave Define has been added successfully');
                }

                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }

        }else{
            if(ApiBaseMethod::checkUrl($request->fullUrl())){

                return ApiBaseMethod::sendError('The type already assigned for the role');
            }else{

                return redirect()->back()->with('message-danger', 'The type already assigned for the role');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $leave_types = SmLeaveType::where('active_status', 1)->get();
        $roles = Role::where('active_status', 1)->get();
        $leave_defines = SmLeaveDefine::where('active_status', 1)->get();
        $leave_define = SmLeaveDefine::find($id);

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data = [];
            $data['leave_types'] = $leave_types->toArray();
            $data['roles'] = $roles->toArray();
            $data['leave_defines'] = $leave_defines->toArray();
            $data['leave_define'] = $leave_define->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.humanResource.leave_define', compact('leave_types', 'holidays', 'roles', 'leave_defines', 'leave_define'));
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
        if(ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'role' => "required",
                'leave_type' => 'required',
                'days' => 'required|numeric',
                'id'=>"required"
            ]);
        }
        else{
            $validator = Validator::make($input, [
                'role' => "required",
                'leave_type' => 'required',
                'days' => 'required|numeric'
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

        $leave_define = SmLeaveDefine::find($request->id);
        $leave_define->role_id = $request->role;
        $leave_define->type_id = $request->leave_type;
        $leave_define->days = $request->days;
        $results = $leave_define->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($results){
                return ApiBaseMethod::sendResponse(null, 'Leave Define has been Updated successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($results){
                return redirect('leave-define')->with('message-success', 'Leave Define has been Updated successfully');
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
    public function destroy(Request $request, $id)
    {
        $result = SmLeaveDefine::destroy($id);

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Leave Define has been deleted successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect('leave-define')->with('message-success-delete', 'Leave Define has been deleted successfully');
            }else{
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }

}
