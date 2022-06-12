<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmItemCategory;
use Validator;

class SmItemCategoryController extends Controller
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
        $itemCategories = SmItemCategory::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($itemCategories, null);
        }
        return view('backEnd.inventory.itemCategoryList', compact('itemCategories'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'category_name' => "required|unique:sm_item_categories,category_name"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $categories = new SmItemCategory();
        $categories->category_name = $request->category_name;
        $results = $categories->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'New Category has been added successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($results) {
                return redirect()->back()->with('message-success', 'New Category has been added successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $editData = SmItemCategory::find($id);
        $itemCategories = SmItemCategory::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['editData'] = $editData->toArray();
            $data['itemCategories'] = $itemCategories->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.inventory.itemCategoryList', compact('itemCategories', 'editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'category_name' => "required|unique:sm_item_categories,category_name," . $id,
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $categories = SmItemCategory::find($id);
        $categories->category_name = $request->category_name;
        $results = $categories->update();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'Category has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($results) {
                return redirect('item-category')->with('message-success', ' Category has been updated successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteItemCategoryView(Request $request,$id)
    {
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($id, null);
        }
        return view('backEnd.inventory.deleteItemCategoryView', compact('id'));
    }

    public function deleteItemCategory(Request $request,$id)
    {
        $result = SmItemCategory::destroy($id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Item Category has been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                return redirect('item-category')->with('message-success-delete', 'Item Category has been deleted successfully');
            } else {
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }
}
