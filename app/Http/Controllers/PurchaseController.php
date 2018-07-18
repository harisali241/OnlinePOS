<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Inventory;
use App\Models\PurchaseMaster;
use App\Models\PurchaseDetail;
use App\Models\Vendor;
use Illuminate\Http\Request;

class PurchaseController extends Controller
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
        $vendors = Vendor::where('company_id','=',auth()->user()->company_id)->pluck('vendor_name','id');
        $purchaseOrder = PurchaseMaster::fetchPurchaseOrder();
        return view('pages.purchase.Purchase',compact('purchaseOrder', 'branches', 'items', 'vendors')); 
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
        $vendors = Vendor::fetchVendors();
        $random = rand(99, 9999999);
        return view('pages.purchase.createPurchase',array(
            'branches' => $branches,
            'items' => $items,
            'vendors' => $vendors,
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
        //dd($request);
        $purchase = PurchaseMaster::createPurchase($request);

        for($i=0; $i < sizeof($request->item_id); $i++)
        {
            PurchaseDetail::createPurchaseDetail($request, $i);
        }

        return redirect('purchase/create')->with('message', 'Successfully Saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        // $branches = branch::where('company_id','=',auth()->user()->company_id)->pluck('branch_name','id');
        // $items = Inventory::where('company_id','=',auth()->user()->company_id)->pluck('item_name','id');
        // $vendors = Vendor::where('company_id','=',auth()->user()->company_id)->pluck('vendor_name','id');
        $purchase = PurchaseMaster::with('branches', 'vendors', 'purchase_details.inventories')->where('id', $id)->get()->first();
        return view('pages.purchase.viewPurchase', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseMaster $purchaseMaster, $id)
    {   
        $branches = branch::where('company_id','=',auth()->user()->company_id)->pluck('branch_name','id');
        $items = Inventory::where('company_id','=',auth()->user()->company_id)->pluck('item_name','id');
        $vendors = Vendor::where('company_id','=',auth()->user()->company_id)->pluck('vendor_name','id');
        $purchase = PurchaseMaster::fetchSinglePurchaseOrder($id);
        return view('pages.purchase.editPurchase',compact('purchase', 'branches', 'items', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $request->validate([
            'purchase_Date' => 'required',
            'branch_id' => 'required',
            'vendor_id' => 'required',
            'purchase_master_no' => 'required',
            'grand_total' => 'required',
        ]);
        $purchase = PurchaseMaster::updatePurchase($request ,$id);
        
        PurchaseDetail::deleteOldDetails($request);
        for($i=0; $i < sizeof($request->item_id); $i++)
        {
            PurchaseDetail::createPurchaseDetail($request, $i);
        }

        return redirect('purchase')->with('message', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseMaster $purchaseMaster, $id)
    {   
        //dd($id);
        PurchaseMaster::findOrFail($id)->delete();
        return redirect('purchase')->with('message', 'Successfully Deleted');
    }

    public function aprovel(Request $request){

        $purchase = PurchaseMaster::findOrFail($request->get('id'));

        $purchase->permission = 1;

        $purchase->save();

        return redirect('purchase')->with('message', 'Successfully Approve');
    }

    public function approve()
    {   
        $branches = branch::where('company_id','=',auth()->user()->company_id)->pluck('branch_name','id');
        $items = Inventory::fetchInventories();
        $vendors = Vendor::where('company_id','=',auth()->user()->company_id)->pluck('vendor_name','id');
        $purchaseOrder = PurchaseMaster::fetchPurchaseOrder();
        return view('pages.purchase.purchaseapprove',compact('purchaseOrder', 'branches', 'items', 'vendors'));
    }

}
