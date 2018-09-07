<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountSetting;
use App\Models\branch;
use App\Models\account;

class AccountSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $accountsettings = AccountSetting::fetchAccountSetting();

        $branches = Branch::fetchBranches();

        $accounts = account::fetchAccounts();

        $edit_accounts = account::where('company_id','=',auth()->user()->company_id)->pluck('account_name','id');

        $edit_branches = branch::where('company_id','=',auth()->user()->company_id)->pluck('branch_name','id');

        return view ('pages.accountsetting.accountsetting',array(
            'accountsettings' => $accountsettings,
            'branches' => $branches,
            'accounts' => $accounts,
            'edit_branches' => $edit_branches,
            'edit_accounts' => $edit_accounts,
        ))->with('accounts');
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
        for($i=0; $i < sizeof($request->module_name); $i++)
        {
            AccountSetting::createAccountSetting($request, $i);
        }

        return redirect('accountsetting')->with('message', 'Successfully Saved');
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
        AccountSetting::updateAccountSetting($request, $id);

        return redirect('accountsetting')->with('message', 'Successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountSetting::findOrFail($id)->delete();
        return redirect('accountsetting')->with('message', 'Successfully Deleted');
    }
}
