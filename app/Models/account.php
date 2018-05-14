<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    protected $fillable = [
        'nature_id', 'account_name'
    ];

    public function account_natures(){
        $this->belongsTo('App/Models/account_nature');
    }

    public function vendors(){
        return $this->hasMany('App\Models\vendor');
    }

    public function customers(){
        $this->hasMany('App/Models/customer');
    }

}
