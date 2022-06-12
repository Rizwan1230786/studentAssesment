<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmDesignation;
use Validator;

class SmDesignationController extends Controller
{

    public function __construct()
    {
        $this->middleware('PM');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $designations = SmDesignation::where('active_status', 1)->get();
        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($designations, null);
        }

        return view('backEnd.humanResource.designation', compact('designations'));
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
            'title' => "required"
        ]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $designation = new SmDesignation();
        $designation->title = $request->title;
        $result = $designation->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Designation has been created successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect()->back()->with('message-success', 'Designation has been created successfully');
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
    public function show(Request $request, $id)
    {
        $designation = SmDesignation::find($id);
        $designations = SmDesignation::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['designation']= $designation->toArray();
            $data['designations']= $designations->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.humanResource.designation', compact('designation', 'designations'));
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
            'title' => "required"
        ]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $designation = SmDesignation::find($request->id);
        $designation->title = $request->title;
        $result = $designation->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Designation has been updated successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect('designation')->with('message-success', 'Designation has been updated successfully');
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
        $designation = SmDesignation::destroy($id);

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($designation){
                return ApiBaseMethod::sendResponse(null, 'Designation has been deleted successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($designation){
                return redirect('designation')->with('message-success-delete', 'Designation has been deleted successfully');
            }else{
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }
}
