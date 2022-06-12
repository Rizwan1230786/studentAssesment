<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmBankAccount;

class SmBankAccountController extends Controller
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
    public function index()
    {
        $bank_accounts = SmbankAccount::all();
        return view('backEnd.accounts.bank_account', compact('bank_accounts'));
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
        $request->validate([
            'account_name' => "required|unique:sm_bank_accounts,account_name",
            'opening_balance' => "required"
        ]);


        $bank_account = new SmbankAccount();
        $bank_account->account_name = $request->account_name;
        $bank_account->opening_balance = $request->opening_balance;
        $bank_account->note = $request->note;
        $result = $bank_account->save();
        if($result){
            return redirect()->back()->with('message-success', 'Bank Account has been created successfully');
        }else{
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
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
        $bank_account = SmbankAccount::find($id);
        $bank_accounts = SmbankAccount::all();
        return view('backEnd.accounts.bank_account', compact('bank_accounts', 'bank_account'));
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
        $request->validate([
            'account_name' => "required|unique:sm_bank_accounts,account_name,".$request->id,
            'opening_balance' => "required"
        ]);


        $bank_account = SmbankAccount::find($request->id);
        $bank_account->account_name = $request->account_name;
        $bank_account->opening_balance = $request->opening_balance;
        $bank_account->note = $request->note;
        $result = $bank_account->save();
        if($result){
            return redirect('bank-account')->with('message-success', 'Bank Account has been updated successfully');
        }else{
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
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
        $bank_account = SmbankAccount::destroy($id);
        if($bank_account){
            return redirect('bank-account')->with('message-success-delete', 'Bank Account has been deleted successfully');
        }else{
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }
}
