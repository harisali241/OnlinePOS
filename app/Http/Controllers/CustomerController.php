<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\branch;
use App\Models\Company;
use App\Models\account;
use Illuminate\Http\Request;
use Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = customer::fetchCustomer();

        $branches = Branch::fetchBranches();

        $accounts = account::fetchAccounts();

        $edit_branches = branch::where('company_id','=',auth()->user()->company_id)->pluck('branch_name','id');

        $edit_accounts = account::where('company_id','=',auth()->user()->company_id)->pluck('account_name','id');

        return view ('pages.customer.customer',array(
            'customers' => $customers,
            'accounts' => $accounts,
            'branches' => $branches,
            'edit_branches' => $edit_branches,
            'edit_accounts' => $edit_accounts,
        ));
    }

    public function store(Request $request)
    {
        //dd($request);
        $this->validate(request(), [
            'account_id' => 'required',
            'company_id' => 'required',
            'branch_id' => "required",
            'customer_name' => "required",
            'customer_email' => "required",
            'customer_phoneNo' => "required",
            'customer_address' => "required",
        ]);

        customer::createCustomer($request);

        return redirect('customer')->with('message', 'Successfully saved');
    }

    public function update(Request $request, $id)
    {

            $this->validate(request(), [
                'account_id' => 'required',
                'company_id' => 'required',
                'branch_id' => "required",
                'customer_name' => "required",
                'customer_email' => "required",
                'customer_phoneNo' => "required",
                'customer_address' => "required",
            ]);

        customer::updateCustomer($request, $id);

        return redirect('customer')->with('message', 'Successfully saved');
    }

    public function destroy($id)
    {
        customer::findOrFail($id)->delete();
        return redirect('customer')->with('message', 'Successfully Deleted');
    }
}
