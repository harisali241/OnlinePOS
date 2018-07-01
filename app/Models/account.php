<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\branch;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Account extends Model
{
    protected $fillable = [
        'nature_id', 'account_name','user_id','branch_id', 'account_number', 'account_contact', 'account_desc', 'account_address', 'opening_credit', 'opening_debit'
    ];

    public function Users()
    {
        return $this->belongsTo('App\User' , 'company_id');
    }

    public function Branches()
    {
        return $this->belongsTo('App\Models\Branch' , 'branch_id');
    }

    public function Vendors(){
        return $this->hasMany('App\Models\Vendor', 'account_id');
    }

    public function account_natures()
    {
        return $this->belongsTo('App\Models\Account_nature');
    }

    public function Customers(){
        return $this->hasMany('App\Models\customer', 'account_id');
    }



    public static function fetchAccounts()
    {
        if(Auth::user()->role_id === 2)
        {
            $accounts = account::with('account_natures')
                ->where('company_id','=',Auth::user()->company_id)->get();
        }
        elseif(Auth::user()->role_id === 3)
        {
            $accounts = account::with('account_natures')
                ->where('company_id','=',Auth::user()->company_id)
                ->where('branch_id','=',Auth::user()->branch_id)->get();
        }


        return $accounts;
    }

    public static function createAccounts(Request $request)
    {

        $account = new account;

        $account->nature_id = request('nature_id');
        $account->user_id = Auth::user()->id;
        $account->branch_id = request('branch_id');
        $account->account_name = request('account_name');
        $account->account_number = request('account_number');
        $account->account_desc = request('account_desc');
        $account->account_address = request('account_address');
        $account->account_contactNo = request('account_contactNo');
        $account->opening_debit = request('opening_debit');
        $account->opening_credit = request('opening_credit');
        $account->save();

    }

    public static function updateAccounts($request, $id)
    {

        $account = account::findOrFail($id);

        $account->branch_id = $request['branch_id'];
        $account->nature_id = $request['nature_id'];
        $account->account_name = $request['account_name'];
        //$account->opening_credit = $request['edit_opening_credit'];
        $account->account_contactNo = $request['account_contactNo'];
        //$account->opening_debit = $request['opening_debit'];
        $account->account_Address = $request['account_Address'];
        $account->account_desc = $request['account_desc'];
        $account->account_number = $request['account_number'];

        $account->save();
    }
}
