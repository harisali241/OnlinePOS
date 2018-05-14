<?php

namespace App\Models;



use App\Models\account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class vendor extends Model
{
    protected $fillable = [
        'account_id', 'vendor_name', 'vendor_email', 'vendor_address', 'vendor_phoneNo', 'status'
    ];

    public function account(){

        return $this->belongsTo('App\Models\account');
    }

    public function company(){

        return $this->belongsTo('App\Models\company');
    }

    public function branch(){

        return $this->belongsTo('App\Models\branch');
    }

    public static function fetchvendor()
    {
        $vendors = vendor::all();
        $accounts = account::all();
        $companies = company::where('status', 1)->get();
        $branches = branch::all();

        return view ('pages.vendor.vendor',compact('vendors','accounts','branches','companies'));
    }

    public static function storevendor(Request $request)
    {

        if(request('status') == null)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $vendor = new Vendor;

        $vendor->account_id = request('account_id');
        $vendor->company_id = request('company_id');
        $vendor->branch_id = request('branch_id');
        $vendor->vendor_name = request('vendor_name');
        $vendor->vendor_email = request('vendor_email');
        $vendor->vendor_phoneNo = request('vendor_phoneNo');
        $vendor->vendor_address = request('vendor_address');
        $vendor->status = $status;

        $vendor->save();
    }


    public static function updatevendor(Request $request, $id){
        if(request('status') == null){
            $status = 0;
        }else{
            $status = 1;
        }

        $vendor = Vendor::findOrFail($id);

        $vendor->account_id = request('account_id');
        $vendor->company_id = request('company_id');
        $vendor->branch_id = request('branch_id');
        $vendor->vendor_name = request('vendor_name');
        $vendor->vendor_email = request('vendor_email');
        $vendor->vendor_phoneNo = request('vendor_phoneNo');
        $vendor->vendor_address = request('vendor_address');
        $vendor->status = $status;

        $vendor->save();

    }

    public static function deletevendor($id)
    {
        vendor::Where('id', $id)->delete();
    }
}
