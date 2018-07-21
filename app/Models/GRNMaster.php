<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseMaster;
use Auth;
use Carbon\Carbon;

class GRNMaster extends Model
{
    protected $fillable = [
        'grn_master_no','date','total_balance','company_id','vendor_id','branch_id','user_id','total_amount'
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
    public function g_r_n_details()
    {
        return $this->hasMany('App\Models\GRNDetail','grn_master_id');
    }

    Public static function fetchGRN(){
    	if(Auth::user()->role_id === 2)
        {	
        	$grn = GRNMaster::where('company_id','=',Auth::user()->company_id)->with('g_r_n_details', 'branches' ,'vendors')->get();
        }
        elseif(Auth::user()->role_id === 3)
        {
            $grn = GRNMaster::where('company_id','=',Auth::user()->company_id)
                ->where('branch_id','=',Auth::user()->branch_id)->with('g_r_n_details', 'branches' ,'vendors')->get();
        }
    	return $grn;
    }

    Public static function fetchSingleGRN($id){
    	if(Auth::user()->role_id === 2)
        {	
        	$grn = GRNMaster::where('id' , $id)->where('company_id','=',Auth::user()->company_id)->with('g_r_n_details.inventories', 'branches' ,'vendors')->get()->first();
        }
        elseif(Auth::user()->role_id === 3)
        {
            $grn = GRNMaster::where('id' , $id)->where('company_id','=',Auth::user()->company_id)
                ->where('branch_id','=',Auth::user()->branch_id)->with('g_r_n_details.inventories', 'branches' ,'vendors')->get()->first();
        }
    	return $grn;
    }

    public static function createGRN($data)
    {	
        $grn = new GRNMaster;
        $grn->company_id = auth()->user()->company_id;
        $grn->user_id = auth()->user()->id;
        $grn->branch_id = $data['branch_id'];
        $grn->vendor_id = $data['vendor_id'];
        $grn->purchase_id = $data['purchase_id'];
        $grn->grn_master_no = $data['grn_master_no'];
        $grn->date = $data['grn_Date'];
        $grn->total_amount = $data['grand_total'];
        $grn->total_balance = $data['total_balance'];
        if($data['total_balance'] == null || $data['total_balance'] == 0){
        	$grn->complete = 1;
        }else{
        	$grn->complete = 0;
        }

        $grn->save();

        if($data['total_balance'] == null || $data['total_balance'] == 0){
        	$purchase = PurchaseMaster::findOrFail( $data['purchase_id'] );
        	$purchase->complete = 1;
        	$purchase->save();
        }else{
        	$purchase = PurchaseMaster::findOrFail( $data['purchase_id'] );
        	$purchase->complete = 0;
        	$purchase->save();
        }
    }



    public static function changePurchaseComplete($id){
    	$purchase_id = GRNMaster::where('id', $id)->pluck('purchase_id')->first();

    	$purchase = PurchaseMaster::findOrFail($purchase_id);
    	$purchase->complete = null;
    	$purchase->save();
    }
}
