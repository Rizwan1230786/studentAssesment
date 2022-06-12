<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmBaseSetup;
use App\SmBaseGroup;


class SmBaseSetupController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }
    
    public function index(){
    	$base_groups = SmBaseGroup::where('active_status', '=', 1)->get();
    	return view('backEnd.systemSettings.baseSetup.base_setup', compact('base_groups'));
    }
    public function store(Request $request){
    	$request->validate([
    		'name' => "required",
    		'base_group' => "required"
    	]);
    	$base_setup = new SmBaseSetup();
    	$base_setup->base_setup_name = $request->name;
    	$base_setup->base_group_id = $request->base_group;
    	$result = $base_setup->save();
    	if($result){
			return redirect()->back()->with('message-success', 'Base Setup has been created successfully');
		}else{
			return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
		} 
    }
    public function edit($id){
    	$base_setup = SmBaseSetup::find($id);
    	$base_groups = SmBaseGroup::where('active_status', '=', 1)->get();
     	return view('backEnd.systemSettings.baseSetup.base_setup', compact('base_setup', 'base_groups'));
    }
    
    public function update(Request $request){
    	$request->validate([
    		'name' => "required",
    		'base_group' => "required"
    	]);

    	$base_group = SmBaseSetup::find($request->id);
    	$base_group->base_setup_name = $request->name;
    	$base_group->base_group_id = $request->base_group;
    	$result = $base_group->save();
    	if($result){
			return redirect('base-setup')->with('message-success', 'Base Group has been updated successfully');
		}else{
			return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
		} 
    }
    public function delete(Request $request){
    	$base_setup = SmBaseSetup::destroy($request->id);
    	if($base_setup){
    		return redirect('base-setup')->with('message-success-delete', 'Base Setup has been deleted successfully');
    	}else{
    		return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
    	}
    }
}
