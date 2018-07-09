<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;


class PurchaseMaster extends Model
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


    Public static function fetchPurchaseOrder(){
    	if(Auth::user()->role_id === 2)
        {	
        	$purchaseOrder = PurchaseMaster::where('company_id','=',Auth::user()->company_id)->with('purchase_details', 'branches' ,'vendors')->get();
        }
        elseif(Auth::user()->role_id === 3)
        {
            $purchaseOrder = PurchaseMaster::where('company_id','=',Auth::user()->company_id)
                ->where('branch_id','=',Auth::user()->branch_id)->with('purchase_details', 'branches' ,'vendors')->get();
        }
    	return $purchaseOrder;
    }

    Public static function fetchSinglePurchaseOrder($id){
    	if(Auth::user()->role_id === 2)
        {	
        	$purchase = PurchaseMaster::where('id', $id)->where('company_id','=',Auth::user()->company_id)->with('purchase_details.inventories', 'branches' ,'vendors')->get()->first();
        }
        elseif(Auth::user()->role_id === 3)
        {
            $purchase = PurchaseMaster::where('id', $id)->where('company_id','=',Auth::user()->company_id)
                ->where('branch_id','=',Auth::user()->branch_id)->with('purchase_details', 'branches' ,'vendors', 'inventories')->get()->first();
        }
    	return $purchase;
    }

    public static function createPurchase($data)
    {
        $purchase = new PurchaseMaster;
        $purchase->company_id = auth()->user()->company_id;
        $purchase->branch_id = $data['branch_id'];
        $purchase->vendor_id = $data['vendor_id'];
        $purchase->user_id = auth()->user()->id;
        $purchase->purchase_master_no = $data['purchase_master_no'];
        $purchase->date = $data['purchase_Date'];
        $purchase->total_amount = $data['grand_total'];

        $purchase->save();

        return $purchase;
    }

    public static function updatePurchase($data, $id)
    {	
        $purchase = PurchaseMaster::findOrFail($id);
        $purchase->company_id = auth()->user()->company_id;
        $purchase->branch_id = $data['branch_id'];
        $purchase->vendor_id = $data['vendor_id'];
        $purchase->user_id = auth()->user()->id;
        $purchase->purchase_master_no = $data['purchase_master_no'];
        $purchase->date = $data['purchase_Date'];
        $purchase->total_amount = $data['grand_total'];

        $purchase->save();

        return $purchase;
    }
}
