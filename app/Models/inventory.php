<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\branch;
use DB;

class Inventory extends Model
{
    protected $fillable = [
        'item_name', 'item_desc', 'purchase_rate', 'sell_rate', 'status', 'account_id', 'user_id', 'branch_id'
    ];

    public function companies()
    {
        return $this->belongsTo('App\Models\Company');
    }
    public function branches()
    {
        return $this->belongsTo('App\Models\Branch');
    }
    public function accounts()
    {
        $this->belongsTo('App/Models/account');
    }



    public static function createInventory(Request $request)
    {
        if(request('status') == 0){
            $status = 0;
        }else{
            $status = 1;
        }

        $inventory = new inventory;

        $inventory->item_name = request('item_name');
        $inventory->item_desc = request('item_desc');
        $inventory->purchase_rate = request('purchase_rate');
        $inventory->sell_rate = request('sell_rate');
        $inventory->alert_qty = request('alert_qty');
        $inventory->account_id = request('account_id');
        $inventory->user_id = request('company_id');
        $inventory->branch_id = request('branch_id');
        $inventory->status = $status;

        $inventory->save();
    }

    public static function updateInventory(Request $request, $id){


        $inventory = inventory::findOrFail($id);

        $inventory->item_name = request('item_name');
        $inventory->item_desc = request('item_desc');
        $inventory->purchase_rate = request('purchase_rate');
        $inventory->sell_rate = request('sell_rate');
        $inventory->alert_qty = request('alert_qty');
        $inventory->account_id = request('account_id');
        $inventory->user_id = request('company_id');
        $inventory->branch_id = request('branch_id');
        $inventory->status = request('status');

        $inventory->save();
    }

}
