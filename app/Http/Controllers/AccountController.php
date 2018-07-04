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

        $branches = Branch::fetchBranches();

        $natures = account_nature::fetchAccountNatures();


        $edit_branches = branch::where('company_id','=',auth()->user()->company_id)->pluck('branch_name','id');
        $edit_natures = account_nature::pluck('nature_name','id');


        return view('pages.account.account',array(

            'branches' => $branches,
            'natures' => $natures,
            'accounts' => $accounts,
            'edit_branches' => $edit_branches,
            'edit_natures' => $edit_natures,
        ));
    }

    public function store(Request $request)
    {
        //dd($request);
        $this->validate(request(), [
            'nature_id' => "required",
            'account_name' => "required",
            'account_number' => "required",

            'account_desc' => "required",

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
            'nature_id' => "required",
            'account_name' => "required",
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
