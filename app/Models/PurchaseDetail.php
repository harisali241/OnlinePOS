<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseMaster;
use Illuminate\Http\Request;
use App\Models\inventory;
use Auth;

class PurchaseDetail extends Model
{
    protected $fillable = [
        'purchase_master_id','company_id','inventory_id','branch_id','qty','rate','amount'
    ];
    public function purchaseMasters()
    {
        return $this->belongsTo('App\Models\purchase_masters','purchase_master_id');
    }
    public function inventories()
    {
        return $this->belongsTo('App\Models\inventory','inventory_id');
    }

    
    public static function createPurchaseDetail(Request $request, $i)
    {
        $purchase_master_id = PurchaseMaster::where('purchase_master_no', $request['purchase_master_no'])->pluck('id')->first();

        $purchase = new PurchaseDetail;

        $purchase->company_id = auth()->user()->company_id;
        $purchase->branch_id = $request['branch_id'];
        $purchase->purchase_master_id = $purchase_master_id;
        $purchase->inventory_id = $request['item_id'][$i];
        $purchase->qty = $request['qnt'][$i];
        $purchase->rate = $request['rate'][$i];
        $purchase->amount = $request['total_amount'][$i];

        $purchase->save();
    }

    public static function deleteOldDetails(Request $request)
    {
        $purchase_master_id = PurchaseMaster::Where('purchase_master_no', $request['purchase_master_no'])->pluck('id')->first();
        PurchaseDetail::Where('purchase_master_id', $purchase_master_id)->delete();
    }
}
