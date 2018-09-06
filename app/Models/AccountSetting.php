<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountSetting extends Model
{
    protected $table = 'id';
    Protected $primaryKey = 'accounts_setting';
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
}
