<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\branch;
use DB;

class inventory extends Model
{
    protected $fillable = [
        'item_name', 'item_desc', 'purchase_rate', 'sell_rate', 'status', 'account_id', 'company_id', 'branch_id'
    ];

    public function companies()
    {
        return $this->belongsTo('App\Model\Company');
    }
    public function branches()
    {
        return $this->belongsTo('App\Model\Branch');
    }
    public function accounts()
    {
        $this->belongsTo('App/Models/account');
    }



    public static function insertInventory(Request $request)
    {
        if(request('status') == null){
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
        $inventory->status = $status;

        $inventory->save();
    }
}
