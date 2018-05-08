<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $fillable = [
        'user_id', 'company_name', 'company_address', 'company_phoneNo', 'status'
    ];

    public function branches(){
        return $this->hasMany('App\Models\Branch', 'company_id');
    }
    public function terminals(){
        return $this->hasMany('App\Models\Terminal', 'company_id');
    }
}
