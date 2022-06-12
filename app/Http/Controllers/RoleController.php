<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\Role;
use Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $roles=Role::all();
        // $roles->truncate();
    }

    public function index(Request $request){
    	$roles = Role::where('active_status', '=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 9)->orderBy('id', 'desc')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($roles, null);
        }

    	return view('backEnd.systemSettings.role.role', compact('roles'));
    }

    
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'name' => "required"
    	]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    	$role = new Role();
    	$role->name = $request->name;
    	$role->type = 'User Defined';
    	$result = $role->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Role has been created successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                return redirect()->back()->with('message-success', 'Role has been created successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function edit(Request $request,$id){
    	$role = Role::find($id);
    	$roles = Role::where('active_status', '=', 1)->orderBy('id', 'desc')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['role'] = $role;
            $data['roles'] = $roles->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
     	return view('backEnd.systemSettings.role.role', compact('role', 'roles'));
    }
    public function update(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'name' => "required"
    	]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

    	$role = Role::find($request->id);
    	$role->name = $request->name;
    	$result = $role->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Role has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                return redirect()->back()->with('message-success', 'Role has been updated successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function delete(Request $request){
    	$role = Role::destroy($request->id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($role) {
                return ApiBaseMethod::sendResponse(null, 'Role has been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($role) {
                return redirect()->back()->with('message-success-delete', 'Role has been deleted successfully');
            } else {
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }

}
