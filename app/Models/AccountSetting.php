<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AccountSetting extends Model
{
    protected $table = 'accounts_setting';
    Protected $primaryKey = 'id';
    Public $timestamps = false;

    Protected $fillable = [

        'account_id', 'module_name','branch_id','user_id'
    ];

    public function accounts()
    {
        return $this->belongsTo('App\Models\account','account_id');
    }

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function branches()
    {
        return $this->belongsTo('App\Models\Branch','branch_id');
    }

    public static function fetchAccountSetting()
    {
        $accountsetting = AccountSetting::all();

        return $accountsetting;
    }

    public static function createAccountSetting(Request $request, $i)
    {
        $accountsetting = new AccountSetting;

        $accountsetting->user_id = auth()->user()->id;
        $accountsetting->module_name = $request['module_name'][$i];
        $accountsetting->account_id = $request['account_id'][$i];
        $accountsetting->branch_id = $request['branch_id'];

        $accountsetting->save();
    }

    public static function updateAccountSetting(Request $request, $id)
    {
        $accountsetting = AccountSetting::findOrFail($id);

        $accountsetting->user_id = $request['user_id'];
        $accountsetting->module_name = $request['module_name'];
        $accountsetting->branch_id = $request['branch_id'];
        $accountsetting->account_id = $request['account_id'];
        $accountsetting->save();
    }

}
