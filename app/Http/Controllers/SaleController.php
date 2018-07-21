<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Branch;
use App\Models\Inventory;
use App\Models\SaleMaster;
use App\Models\SaleDetail;
use App\Models\Customer;
use App\Models\Terminal;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = branch::where('company_id','=',auth()->user()->company_id)->pluck('branch_name','id');
        $items = Inventory::fetchInventories();
        $customers = Customer::pluck('customer_name','id');
        $saleOrder = SaleMaster::fetchSaleOrder();
        return view('pages.sale.Sale',compact('saleOrder', 'branches', 'items', 'customers')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::fetchBranches();
        $items = Inventory::fetchInventories();
        $customers = Customer::fetchCustomer();
        $terminals = Terminal::fetchTerminals();
        $random = rand(99, 9999999);
        return view('pages.sale.createSale',array(
            'branches' => $branches,
            'items' => $items,
            'customers' => $customers,
            'terminals' => $terminals,
            'random' => $random,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = SaleMaster::createSale($request);

        for($i=0; $i < sizeof($request->item_id); $i++)
        {
            SaleDetail::createSaleDetail($request, $i);
        }

        return redirect('sale/create')->with('message', 'Successfully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleMaster $SaleMaster, $id)
    {
        $branches = branch::where('company_id','=',auth()->user()->company_id)->pluck('branch_name','id');
        $items = Inventory::where('company_id','=',auth()->user()->company_id)->pluck('item_name','id');
        $customers = Customer::where('company_id','=',auth()->user()->company_id)->pluck('customer_name','id');
        $terminals = Terminal::pluck('terminal_name','id');
        $sale = SaleMaster::fetchSingleSaleOrder($id);
        return view('pages.sale.editSale',compact('sale', 'branches', 'items', 'customers','terminals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'sale_Date' => 'required',
        //     'branch_id' => 'required',
        //     'sale_master_no' => 'required',
        //     'grand_total' => 'required',
        // ]);

        $delupdate = SaleDetail::where('sale_master_id',$id)->get();

        foreach($delupdate as $del)
        {
            $inventoryupdate = Inventory::where('id', $del->inventory_id)->get();

            foreach($inventoryupdate as $invent)
            {
                $totalupdate = $del->qty + $invent->current_qty;

                $inventory = Inventory::findOrFail($invent->id);
                $inventory->current_qty = $totalupdate;
                $inventory->save();
            }
        }

        $sale = SaleMaster::updateSale($request ,$id);
        
        SaleDetail::deleteOldDetailssale($request);

        $sale = SaleMaster::updateSale($request ,$id);
        
        SaleDetail::deleteOldDetailssale($request);

        for($i=0; $i < sizeof($request->item_id); $i++)
        {
            SaleDetail::createSaleDetail($request, $i);
        }

        return redirect('sale')->with('message', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SaleMaster::findOrFail($id)->delete();
        return redirect('sale')->with('message', 'Successfully Deleted');
    }
}
