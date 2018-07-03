<?php

namespace App\Models;


use App\Models\account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Vendor extends Model
{
    protected $fillable = [
        'account_id','user_id','branch_id', 'vendor_name', 'vendor_email', 'vendor_address', 'vendor_phoneNo', 'status','company_id'
    ];

    public function accounts()
    {
        return $this->belongsTo('App\Models\Account' , 'account_id');
    }

    public static function fetchVendors()
    {
        $vendors = vendor::with('accounts')->get();

        return $vendors;
    }

    public static function createVendors(Request $request)
    {
        $vendor = new Vendor;

        $vendor->company_id = $request['company_id'];
        $vendor->user_id = $request['user_id'];
        $vendor->branch_id = $request['branch_id'];
        $vendor->account_id = $request['account_id'];
        $vendor->vendor_name = $request['vendor_name'];
        $vendor->vendor_email = $request['vendor_email'];
        $vendor->vendor_phoneNo = $request['vendor_phoneNo'];
        $vendor->vendor_address = $request['vendor_address'];
        $vendor->status = $request['status'];
        $vendor->save();
    }


    public static function updateVendors(Request $request, $id)
    {
        $vendor = vendor::findOrFail($id);

        $vendor->company_id = $request['company_id'];
        $vendor->user_id = $request['user_id'];
        $vendor->branch_id = $request['branch_id'];
        $vendor->account_id = $request['account_id'];
        $vendor->vendor_name = $request['vendor_name'];
        $vendor->vendor_email = $request['vendor_email'];
        $vendor->vendor_phoneNo = $request['vendor_phoneNo'];
        $vendor->vendor_address = $request['vendor_address'];
        $vendor->status = $request['status'];
        $vendor->save();
    }
}
