<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GRNMaster;
use Illuminate\Http\Request;
use App\Models\inventory;
use Auth;

class GRNDetail extends Model
{
    protected $fillable = [
        'grn_master_id','company_id','inventory_id','branch_id','qty','rate','amount','balance'
    ];
    public function g_r_n_masters()
    {
        return $this->belongsTo('App\Models\GRNmasters','grn_master_id');
    }
    public function inventories()
    {
        return $this->belongsTo('App\Models\Inventory','inventory_id');
    }

    public static function createGRNDetail(Request $request, $i)
    {
        $grn_master_id = GRNMaster::where('grn_master_no', $request['grn_master_no'])->pluck('id')->first();
        $balance = ($request['qty'][$i] - $request['receive_qty'][$i]);

        if($balance == ''){
        	$balance = 0;
        }

        $grn = new GRNDetail;

        $grn->company_id = auth()->user()->company_id;
        $grn->user_id = auth()->user()->id;
        $grn->vendor_id = $request['vendor_id'];
        $grn->branch_id = $request['branch_id'];
        $grn->grn_master_id = $grn_master_id;
        $grn->inventory_id = $request['item_id'][$i];
        $grn->qty = $request['receive_qty'][$i];
        $grn->rate = $request['rate'][$i];
        $grn->amount = $request['receive_qty'][$i]*$request['rate'][$i];
        $grn->balance = $balance;

        $grn->save();
    }

    public static function deleteOldGRNDetails(Request $request)
    {
        $grn_master_id = GRNMaster::Where('grn_master_no', $request['grn_master_no'])->pluck('id')->first();
        GRNDetail::Where('grn_master_id', $grn_master_id)->delete();
    }

}
