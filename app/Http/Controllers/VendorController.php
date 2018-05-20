<?php

namespace App\Http\Controllers;


use App\Models\account;
use Illuminate\Http\Request;
use App\Models\vendor;
use App\Models\branch;
use App\Models\Company;
use Auth;

class VendorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendors = vendor::fetchVendors();

        $accounts = account::fetchAccounts();

        $companies = company::fetchCompanies();

        return view ('pages.vendor.vendor',array(
            'vendors' => $vendors,
            'accounts' => $accounts,
            'companies' => $companies,
        ));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'account_id' => 'required',
            'company_id' => 'required',
            'branch_id' => "required",
            'vendor_name' => "required",
            'vendor_email' => "required",
            'vendor_phoneNo' => "required",
            'vendor_address' => "required",
        ]);

        vendor::createVendors($request);

        return redirect('vender')->with('message', 'Successfully saved');

    }

    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'account_id' => 'required',
            'company_id' => 'required',
            'branch_id' => "required",
            'vendor_name' => "required",
            'vendor_email' => "required",
            'vendor_phoneNo' => "required",
            'vendor_address' => "required",
        ]);

        vendor::updateVendors($request, $id);
        return redirect('vender')->with('message', 'Successfully Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        vendor::findOrFail($id)->delete();
        return redirect('vender')->with('message', 'Successfully Deleted');

    }
}
