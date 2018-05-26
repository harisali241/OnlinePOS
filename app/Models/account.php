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
        'nature_id', 'accounts_name','user_id','branch_id', 'accounts_number', 'account_contact', 'accounts_desc', 'account_address', 'opening_credit', 'opening_debit'
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

    public function Account_natures()
    {
        return $this->belongsTo('App\Models\Account_nature' , 'id');
    }

    public function Customers(){
        return $this->hasMany('App\Models\customer', 'account_id');
    }



    public static function fetchAccounts()
    {
        $accounts = account::with('branches','account_natures')->get();

        return $accounts;
    }

    public static function createAccounts(Request $request)
    {

        $account = new account;

        $account->nature_id = request('nature_id');
        $account->user_id = Auth::user()->id;
        $account->branch_id = Auth::user()->branch_id;
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

        $account->company_id = $request['company_id'];
        $account->branch_id = $request['branch_id'];
        $account->nature_id = $request['nature_id'];
        $account->accounts_name = $request['accounts_name'];

        $account->save();
    }
}
