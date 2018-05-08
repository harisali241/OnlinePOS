<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    protected $fillable = [
        'account_id', 'vendor_name', 'vendor_email', 'vendor_address', 'vendor_phoneNo', 'status'
    ];

    public function vendors(){
        $this->hasMany('App/Models/vendor');
    }
}
