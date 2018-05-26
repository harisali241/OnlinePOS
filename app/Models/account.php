<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function Natures()
    {
        return $this->belongsTo('App\Models\account_nature' , 'nature_id');
    }

    public function Customers(){
        return $this->hasMany('App\Models\customer', 'account_id');
    }



    public static function fetchAccounts()
    {
        $accounts = account::with('branches','natures')->get();

        return $accounts;
    }

    public static function createAccounts($request)
    {

        $account = new account;

        $account->company_id = $request['company_id'];
        $account->branch_id = $request['branch_id'];
        $account->nature_id = $request['nature_id'];
        $account->accounts_name = $request['accounts_name'];
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
