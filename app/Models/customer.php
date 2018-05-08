<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = [
        'account_id', 'customer_name', 'customer_email', 'customer_address', 'customer_phoneNo', 'status', 'credit_limit'
    ];

    public function customers(){
        $this->hasMany('App/Models/account');
    }
}
