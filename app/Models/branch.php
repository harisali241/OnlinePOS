<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    protected $fillable = [
        'company_id', 'branch_name', 'branch_address', 'branch_phoneNo', 'status'
    ];

    public function terminals(){
        return $this->hasMany('App\Models\Terminal' ,'branch_id');
    }
    public function companies()
    {
        return $this->belongsTo('App\Models\Company' , 'company_id');
    }
}
