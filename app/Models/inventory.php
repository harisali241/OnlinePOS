<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\branch;
use App\User;
use DB;
use Auth;

class Inventory extends Model
{
    protected $fillable = [
        'item_name', 'item_desc', 'purchase_rate', 'sell_rate', 'status', 'account_id', 'user_id', 'branch_id','current_qty'
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
    public function purchase_details()
    {
        return $this->hasMany('App\Models\purchase_details','inventory_id');
    }
    public function sale_details()
    {
        return $this->hasMany('App\Models\SaleDetail','inventory_id');
    }

    public static function fetchInventories(){
        
        if(Auth::user()->role_id === 2)
        {
            $inventories = inventory::where('company_id','=',Auth::user()->company_id)->get();
        }
        elseif(Auth::user()->role_id === 3)
        {
            $inventories = inventory::where('company_id','=',Auth::user()->company_id)
                ->where('branch_id','=',Auth::user()->branch_id)->get();
        }
        return $inventories;

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
        $inventory->opening_qty = request('opening_qty');
        $inventory->current_qty = request('opening_qty');
        $inventory->alert_qty = request('alert_qty');
        $inventory->account_id = request('account_id');
        $inventory->user_id = Auth::user()->id;
        $inventory->company_id = request('company_id');
        $inventory->branch_id = request('branch_id');
        $inventory->status = $status;

        $inventory->save();
    }

    public static function updateInventory(Request $request, $id){


        $inventory = inventory::findOrFail($id);

        $inventory->item_name = request('item_name');
        $inventory->item_desc = request('item_desc');
        $inventory->opening_qty = request('opening_qty');
        $inventory->current_qty = request('opening_qty');
        $inventory->alert_qty = request('alert_qty');
        $inventory->user_id = Auth::user()->id;
        $inventory->company_id = Auth::user()->company_id;
        $inventory->status = request('status');

        $inventory->save();
    }

}
