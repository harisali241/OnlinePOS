<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;

class Customer extends Model
{
    protected $fillable = [
        'account_id', 'company_id' ,'user_id','branch_id', 'customer_name', 'customer_email', 'customer_address', 'customer_phoneNo', 'status'
    ];

    public function Accounts()
    {
        return $this->belongsTo('App\Models\Account' , 'account_id');
    }

    public static function fetchCustomer()
    {
        if(Auth::user()->role_id === 2)
        {
            $customers = customer::where('company_id','=',Auth::user()->company_id)->get();
        }
        elseif(Auth::user()->role_id === 3)
        {
            $customers = account::where('company_id','=',Auth::user()->company_id)
                ->where('branch_id','=',Auth::user()->branch_id)->get();
        }

        return $customers;
    }

    public static function createCustomer(Request $request)
    {
        $customer = new customer;

        $customer->user_id = $request['user_id'];
        $customer->company_id = $request['company_id'];
        $customer->branch_id = $request['branch_id'];
        $customer->account_id = $request['account_id'];
        $customer->customer_name = $request['customer_name'];
        $customer->customer_email = $request['customer_email'];
        $customer->customer_phoneNo = $request['customer_phoneNo'];
        $customer->customer_address = $request['customer_address'];
        $customer->status = $request['status'];
        $customer->save();
    }


    public static function updateCustomer(Request $request, $id)
    {
        $customer = customer::findOrFail($id);

        $customer->user_id = $request['user_id'];
        $customer->company_id = $request['company_id'];
        $customer->branch_id = $request['branch_id'];
        $customer->account_id = $request['account_id'];
        $customer->customer_name = $request['customer_name'];
        $customer->customer_email = $request['customer_email'];
        $customer->customer_phoneNo = $request['customer_phoneNo'];
        $customer->customer_address = $request['customer_address'];
        $customer->status = $request['status'];
        $customer->save();
    }
}
