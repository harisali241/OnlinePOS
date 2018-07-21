<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SaleMaster;
use Illuminate\Http\Request;
use App\Models\inventory;
use Auth;

class SaleDetail extends Model
{
    protected $fillable = [
        'sale_master_id','company_id','inventory_id','branch_id','qty','rate','amount','user_id'
    ];

    public function sale_masters()
    {
        return $this->belongsTo('App\Models\SaleMaster','sale_master_id');
    }
    public function inventories()
    {
        return $this->belongsTo('App\Models\inventory','inventory_id');
    }

    public static function createSaleDetail(Request $request, $i)
    {
        $item = $request['item_id'][$i];

        $quantity = $request['qnt'][$i];

        $sale_master_id = SaleMaster::where('sale_master_no', $request['sale_master_no'])->pluck('id')->first();

        $invent = Inventory::where('id','=',$item)->pluck('current_qty')->first();

        $total = $invent - $quantity;

            $sale = new SaleDetail;
            $sale->company_id = auth()->user()->company_id;
            $sale->branch_id = $request['branch_id'];
            $sale->sale_master_id = $sale_master_id;
            $sale->user_id = auth()->user()->id;
            $sale->customer_id = $request['customer_id'];
            $sale->terminal_id = $request['terminal_id'];
            $sale->inventory_id = $item;
            $sale->qty = $quantity;
            $sale->rate = $request['rate'][$i];
            $sale->amount = $request['total_amount'][$i];

            $sale->save();

            $inventory = Inventory::findOrFail($item);
            $inventory->current_qty = $total;
            $inventory->save();
        
        $sale_master_id = SaleMaster::where('sale_master_no', $request['sale_master_no'])->pluck('id')->first();

        $sale = new SaleDetail;

        $sale->company_id = auth()->user()->company_id;
        $sale->branch_id = $request['branch_id'];
        $sale->sale_master_id = $sale_master_id;
        $sale->user_id = auth()->user()->id;
        $sale->customer_id = $request['customer_id'];
        $sale->terminal_id = $request['terminal_id'];
        $sale->inventory_id = $request['item_id'][$i];
        $sale->qty = $request['qnt'][$i];
        $sale->rate = $request['rate'][$i];
        $sale->amount = $request['total_amount'][$i];

        $sale->save();
    }

    public static function deleteOldDetailssale(Request $request)
    {
        $sale_master_id = SaleMaster::Where('sale_master_no', $request['sale_master_no'])->pluck('id')->first();
        SaleDetail::Where('sale_master_id', $sale_master_id)->delete();
    }
}
