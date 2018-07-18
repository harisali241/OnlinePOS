<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class SaleMaster extends Model
{
    protected $fillable = [
        'sale_master_no','date','terminal_id','company_id','customer_id','branch_id','user_id'
    ];

    public function customers()
    {
        return $this->belongsTo('App\Models\Customer','customer_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function branches()
    {
        return $this->belongsTo('App\Models\branch','branch_id');
    }
    public function sale_details()
    {
        return $this->hasMany('App\Models\SaleDetail','sale_master_id');
    }

    Public static function fetchSaleOrder(){
    	if(Auth::user()->role_id === 2)
        {
        	$saleOrder = SaleMaster::where('company_id','=',Auth::user()->company_id)->with('sale_details.inventories', 'branches' ,'customers')->get();
        }
        elseif(Auth::user()->role_id === 3)
        {
            $saleOrder = SaleMaster::where('branch_id','=',Auth::user()->branch_id)->with('sale_details.inventories', 'branches' ,'customers')->get();
        }
    	return $saleOrder;
    }

    Public static function fetchSingleSaleOrder($id){
        if(Auth::user()->role_id === 2)
        {
            $sale = SaleMaster::where('id', $id)->with('sale_details.inventories', 'branches' ,'customers')->get()->first();
        }
        elseif(Auth::user()->role_id === 3)
        {
            $sale = SaleMaster::where('id', $id)->where('branch_id','=',Auth::user()->branch_id)->with('sale_details', 'branches' ,'customers', 'inventories')->get()->first();
        }
        return $sale;
    }

    public static function createSale($data)
    {
        $sale = new SaleMaster;
        $sale->company_id = auth()->user()->company_id;
        $sale->branch_id = $data['branch_id'];
        $sale->terminal_id = $data['terminal_id'];
        $sale->customer_id = $data['customer_id'];
        $sale->user_id = auth()->user()->id;
        $sale->sale_master_no = $data['sale_master_no'];
        $sale->date = $data['sale_Date'];
        $sale->total_amount = $data['grand_total'];

        $sale->save();

        return $sale;
    }

    public static function updateSale($data, $id)
    {
        $sale = SaleMaster::findOrFail($id);
        $sale->company_id = auth()->user()->company_id;
        $sale->user_id = auth()->user()->id;
        $sale->branch_id = $data['branch_id'];
        $sale->customer_id = $data['customer_id'];
        $sale->terminal_id = $data['terminal_id'];
        $sale->sale_master_no = $data['sale_master_no'];
        $sale->date = $data['sale_Date'];
        $sale->total_amount = $data['grand_total'];

        $sale->save();

        return $sale;
    }
}
