<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'sale_master_no','date','terminal_id','company_id','customer_id','branch_id','user_id'
    ];

    public function customers()
    {
        return $this->belongsTo('App\Models\Customer','customer_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function branches()
    {
        return $this->belongsTo('App\Models\branch','branch_id');
    }
    public function sales_details()
    {
        return $this->hasMany('App\Models\SaleDetail','sale_master_id');
    }
}
