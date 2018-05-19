<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    protected $fillable = [
        'nature_id', 'accounts_name','company_id','branch_id'
    ];

    public function companies()
    {
        return $this->belongsTo('App\Models\Company' , 'company_id');
    }

    public function branches()
    {
        return $this->belongsTo('App\Models\Branch' , 'branch_id');
    }

    public function vendors(){
        return $this->hasMany('App\Models\Vendor', 'account_id');
    }

    public function natures()
    {
        return $this->belongsTo('App\Models\account_nature' , 'nature_id');
    }

    public function customers(){
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
