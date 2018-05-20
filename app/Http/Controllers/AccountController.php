<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\account_nature;
use App\Models\branch;
use App\Models\Company;
use Illuminate\Http\Request;

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

        $companies = company::fetchCompanies();

        $natures = account_nature::fetchAccountNatures();

        return view ('pages.account.account',array(
            'accounts' => $accounts,
            'companies' => $companies,
            'natures' => $natures,
        ));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'company_id' => 'required',
            'branch_id' => "required",
            'nature_id' => "required",
            'accounts_name' => "required",
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