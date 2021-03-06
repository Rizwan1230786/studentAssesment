<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmPaymentMethhod;
use Validator;

class SmPaymentMethodController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    public function index(Request $request){
    	$payment_methods = SmPaymentMethhod::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($payment_methods, null);
        }
    	return view('backEnd.accounts.payment_method', compact('payment_methods'));

    }
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'method' => "required|unique:sm_payment_methhods,method",
    	]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

    	$payment_method = new SmPaymentMethhod();
    	$payment_method->method = $request->method;
    	$result = $payment_method->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Method has been created successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect()->back()->with('message-success', 'Method has been created successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }

    public function edit(Request $request,$id){
    	$payment_method = SmPaymentMethhod::find($id);
    	$payment_methods = SmPaymentMethhod::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['payment_method']= $payment_method->toArray();
            $data['payment_methods']= $payment_methods->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
     	return view('backEnd.accounts.payment_method', compact('payment_method', 'payment_methods'));
    }
    public function update(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'method' => "required|unique:sm_payment_methhods,method,".$request->id,
    	]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $payment_method = SmPaymentMethhod::find($request->id);
    	$payment_method->method = $request->method;
    	$result = $payment_method->save();


        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Method has been updated successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect('payment-method')->with('message-success', 'Method has been updated successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function delete(Request $request,$id){
    	$student_group = SmPaymentMethhod::destroy($id);

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($student_group){
                return ApiBaseMethod::sendResponse(null, 'Method has been deleted successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($student_group){
                return redirect()->back()->with('message-success-delete', 'Method has been deleted successfully');
            }else{
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }
}
