<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmSupplier;
use Validator;
class SmSupplierController extends Controller
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
        $suppliers = SmSupplier::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($suppliers, null);
        }
        return view('backEnd.inventory.supplierList', compact('suppliers'));
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
           'company_name' => "required",
           'company_address' => "required",
           'contact_person_name' => "required",
           'contact_person_mobile' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

       $suppliers = new SmSupplier();
       $suppliers->company_name = $request->company_name;
       $suppliers->company_address = $request->company_address;
       $suppliers->contact_person_name = $request->contact_person_name;
       $suppliers->contact_person_mobile = $request->contact_person_mobile;
       $suppliers->contact_person_email = $request->contact_person_email;
       $suppliers->description = $request->description;
       // $suppliers->created_by = Auth()->user()->id;
       $results = $suppliers->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'New Supplier has been added successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($results) {
                return redirect()->back()->with('message-success', 'New Supplier has been added successfully');
            } else {
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
       $editData = SmSupplier::find($id);
       $suppliers = SmSupplier::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['editData'] = $editData->toArray();
            $data['suppliers'] = $suppliers->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
       return view('backEnd.inventory.supplierList', compact('editData', 'suppliers'));
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
           'company_name' => "required",
           'company_address' => "required",
           'contact_person_name' => "required",
           'contact_person_mobile' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       
       $suppliers = SmSupplier::find($id);
       $suppliers->company_name = $request->company_name;
       $suppliers->company_address = $request->company_address;
       $suppliers->contact_person_name = $request->contact_person_name;
       $suppliers->contact_person_mobile = $request->contact_person_mobile;
       $suppliers->contact_person_email = $request->contact_person_email;
       $suppliers->description = $request->description;
       $suppliers->updated_by = Auth()->user()->id;
       $results = $suppliers->update();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null,  'Supplier has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($results) {
                return redirect('suppliers')->with('message-success', 'Supplier has been updated successfully');
            } else {
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
    public function destroy($id)
    {
        //
    }

    public function deleteSupplierView(Request $request,$id){

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($id, null);
        }
         return view('backEnd.inventory.deleteSupportView', compact('id'));
    }

    public function deleteSupplier(Request $request,$id){
        $result = SmSupplier::destroy($id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Supplier has been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                return redirect('suppliers')->with('message-success-delete', 'Supplier has been deleted successfully');
            } else {
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }
}
