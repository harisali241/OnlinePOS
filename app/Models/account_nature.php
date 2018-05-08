<?php

namespace App\Moldels;

use Illuminate\Database\Eloquent\Model;

class account_nature extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nature_name'
    ];

    public function accounts(){
        $this->hasMany('App/Models/account');
    }
}
