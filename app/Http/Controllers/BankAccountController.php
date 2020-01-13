<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\FinancialOrganization;
use Validator;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    // all accounts
    public function index()
    {
        $accounts=[];
        foreach (BankAccount::all() as $value){
            $jsonTransaction = [
                'id'     => $value->id,
                'bank_name'   => $value->financial_organization->name,
                'account_name'  => $value->account_name,
                'account_no' => $value->account_no,
                'branch' => $value->branch,
                'account_type' => $value->account_type
            ];
            array_push($accounts, $jsonTransaction);
        }
        return array_reverse($accounts);
    }

    // add account
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'account_name' => 'required|min:10',
            'financial_organization_id' => 'required',
            'account_no' => 'required',
            'branch' => 'required',
            'account_type' => 'required',
            'swift_code' => 'required',
            'route_no' => 'required'
        ], [
            'account_name.required' => 'Please give the Account Name',
            'account_name.min' => 'The Minimum length is 10',
            'financial_organization_id.required' => 'Please select the Bank',
            'account_type.required' => 'Please select the Account Type'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);
        }

        $accounts = new BankAccount([
            'financial_organization_id' => $request->input('financial_organization_id'),
            'account_name' => $request->input('account_name'),
            'account_no' => $request->input('account_no'),
            'branch' => $request->input('branch'),
            'account_type' => $request->input('account_type'),
            'swift_code' => $request->input('swift_code'),
            'route_no' => $request->input('route_no')
        ]);
        $accounts->save();

        return response()->json('The account successfully added');
    }

    public function getbanks()
    {
        $data = FinancialOrganization::get();
        return response()->json($data);
    }

    // edit account
    public function edit($id)
    {
        $accounts = BankAccount::find($id);
        return response()->json($accounts);
    }

    // update account
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'account_name' => 'required|min:10',
            'account_no' => 'required',
            'branch' => 'required',
            'swift_code' => 'required',
            'route_no' => 'required'
        ], [
            'account_name.required' => 'Please give the Account Name',
            'account_name.min' => 'The Minimum length is 10'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);
        }
        $accounts = BankAccount::find($id);
        $accounts->update($request->all());

        return response()->json('The account successfully updated');
    }

    // delete account
    public function delete($id)
    {
        $accounts = BankAccount::find($id);
        $accounts->delete();

        return response()->json('The account successfully deleted');
    }
}
