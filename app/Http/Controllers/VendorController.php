<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\vendor;
use Auth;

class VendorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return vendor::fetchvendor();
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

        vendor::storevendor($request);

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

        vendor::updatevendor($request, $id);

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
        vendor::deletevendor($id);
        return redirect('vender')->with('message', 'Successfully Deleted');

    }
}
