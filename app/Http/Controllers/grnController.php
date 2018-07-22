<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Inventory;
use App\Models\PurchaseMaster;
use App\Models\PurchaseDetail;
use App\Models\GRNMaster;
use App\Models\GRNDetail;
use App\Models\Vendor;
use Illuminate\Http\Request;

class grnController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $grns = GRNMaster::fetchGRN();
        return view('pages.grn.inCompleteGRN', compact('grns'));
    }

    public function complete()
    {   
        $grns = GRNMaster::fetchGRN();
        return view('pages.grn.completedGRN', compact('grns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        $random = rand(99, 9999999);
        $purchaseOrder = PurchaseMaster::where('permission' , 1)->where('complete' , null)->get();
        return view('pages.grn.createGRN', compact('purchaseOrder', 'random'));
    }

    public function reqPO(Request $request){

        $purchaseOrder = PurchaseMaster::fetchSinglePurchaseOrder($request->id);
        return response($purchaseOrder);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        GRNMaster::createGRN($request);

        for($i=0; $i < sizeof($request->item_id); $i++)
        {
            GRNDetail::createGRNDetail($request, $i);
        }

        return redirect('grn/create')->with('message', 'Successfully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grn = GRNMaster::fetchSingleGRN($id);
        return view('pages.grn.viewGRN', compact('grn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grn = GRNMaster::fetchSingleGRN($id);
        return view('pages.grn.editGRN', compact('grn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request->all();
        $request->validate([
            'grn_Date' => 'required',
            'branch_id' => 'required',
            'vendor_id' => 'required',
            'grn_master_no' => 'required',
            'grand_total' => 'required',
        ]);

        GRNMaster::updateGRN($request, $id);
        GRNDetail::deleteOldGRNDetails($request);
        for($i=0; $i < sizeof($request->item_id); $i++)
        {
            GRNDetail::createGRNDetail($request, $i);
        }

        return redirect('grn')->with('message', 'Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        GRNMaster::changePurchaseComplete($id);
        GRNMaster::findOrFail($id)->delete();
        return redirect('grn')->with('message', 'Successfully Deleted');
    }
}
