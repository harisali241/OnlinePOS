<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class terminal extends Model
{
    protected $fillable = [
        'company_id', 'branch_id', 'terminal_name', 'terminal_address', 'terminal_phoneNo', 'status'
    ];

    public function companies()
    {
        return $this->belongsTo('App\Model\Company');
    }
    public function branches()
    {
        return $this->belongsTo('App\Model\Branch');
    }
}
