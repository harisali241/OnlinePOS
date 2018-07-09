<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'purchase_master_no','date','permission','company_id','vendor_id','branch_id','user_id'
    ];

    public function vendors()
    {
        return $this->belongsTo('App\Models\Vendor','vendor_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function branches()
    {
        return $this->belongsTo('App\Models\branch','branch_id');
    }
    public function purchase_details()
    {
        return $this->hasMany('App\Models\PurchaseDetail','purchase_master_id');
    }

    public static function createPurchase($data)
    {
        $purchase = new Purchase;
        $purchase->company_id = auth()->user()->company_id;
        $purchase->branch_id = $data['branch_id'];
        $purchase->vendor_id = $data['vendor_id'];
        $purchase->user_id = auth()->user()->id;
        $purchase->purchase_master_no = $data['purchase_master_no'];
        $purchase->date = $data['purchase_Date'];
        $purchase->amount = $data['grand_total'];

        $purchase->save();

        return $purchase;
    }

}
