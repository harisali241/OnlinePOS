<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = [
        'branch_id','company_id','purchase_master_id','inventory_id','qty'
        ,'rate','amount'
    ];

    public function purchase_masters()
    {
        return $this->belongsTo('App\Models\Purchase','purchase_master_id');
    }

    public function branches()
    {
        return $this->belongsTo('App\Models\branch','branch_id');
    }

    public static function createPurchaseDetail($data,$master_id,$i)
    {
        $purchaseDetail = new PurchaseDetail;

        $purchaseDetail->branch_id = $data['branch_id'];
        $purchaseDetail->company_id = auth()->user()->company_id;
        $purchaseDetail->purchase_master_id = $master_id;
    }
}
