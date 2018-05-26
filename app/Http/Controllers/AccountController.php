<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\account_nature;
use App\Models\branch;
use App\Models\Company;
use Illuminate\Http\Request;
use App\User;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = account::fetchAccounts();
        $company = User::fetchCompanyFromUser();
        $branch = User::fetchBranchFromUser();
        $natures = account_nature::fetchAccountNatures();

        return view ('pages.account.account',array(
            'accounts' => $accounts,
            'company' => $company,
            'branch' => $branch,
            'natures' => $natures,
        ));
    }

    public function store(Request $request)
    {
        //dd($request);
        $this->validate(request(), [
            'nature_id' => "required",
            'account_name' => "required",
            'account_number' => "required",
            'account_contactNo' => "required",
            'account_desc' => "required",
            'account_address' => "required",
            'opening_credit' => "required",
            'opening_debit' => "required",
        ]);
        
        account::createAccounts($request);

        return redirect('account')->with('message', 'Successfully saved');
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
        $this->validate(request(), [
            'company_id' => 'required',
            'branch_id' => "required",
            'nature_id' => "required",
            'accounts_name' => "required",
        ]);
        account::updateAccounts($request, $id);
        return redirect('account')->with('message', 'Successfully Edit');
    }

    public function destroy($id)
    {
        account::findOrFail($id)->delete();
        return redirect('account')->with('message', 'Successfully Deleted');
    }
}
