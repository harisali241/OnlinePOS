<?php

namespace App\Moldels;

use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    protected $fillable = [
        'nature_id', 'account_name'
    ];

    public function accounts(){
        $this->belongsTo('App/Models/account_nature');
    }
    public function vendors(){
        $this->hasMany('App/Models/vendor');
    }
    public function customers(){
        $this->hasMany('App/Models/customer');
    }

}
