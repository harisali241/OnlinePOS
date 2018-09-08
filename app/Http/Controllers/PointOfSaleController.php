<?php

namespace App\Http\Controllers;

use App\Models\PointOfSale;
use Illuminate\Http\Request;
use App\Models\GRNMaster;
use App\Models\GRNDetail;
use App\Models\Inventory;
use Auth;

class PointOfSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('pages.sale.pos', compact('items'));
    }

    public function getSearhItem(Request $request){


        if(Auth::user()->branch_id == null){
            $invs = Inventory::where('company_id', Auth::user()->company_id)
                            ->where('item_name' ,'like', '%'.$request->item.'%')
                            ->pluck('id');
            $grn_m = GRNMaster::where('complete', 1)->pluck('id');
            $items = GRNDetail::whereIn('inventory_id', $invs)
                                ->whereIn('grn_master_id', $grn_m)
                                ->with('inventories')
                                ->orderBy('created_at')
                                ->get();

        }else{
            $invs = Inventory::where('company_id', Auth::user()->company_id)
                            ->where('branch_id', Auth::user()->branch_id)
                            ->where('item_name' ,'like', '%'.$request->item.'%')
                            ->pluck('id');
            $grn_m = GRNMaster::where('complete', 1)->pluck('id');
            $items = GRNDetail::whereIn('inventory_id', $invs)
                                ->whereIn('grn_master_id', $grn_m)
                                ->with('inventories')
                                ->orderBy('created_at')
                                ->get();
        }
        

        $itemRec = [];
        for($i=0; $i<count($items); $i++){          
            if(!in_array($items[$i]->inventories->item_name, array_column($itemRec, 'name'))){
                array_push($itemRec, [
                    "id" => $items[$i]->inventory_id,
                    "company_id" => $items[$i]->company_id,
                    "name" => $items[$i]->inventories->item_name,
                    "qty" => $items[$i]->qty,
                    "rate" => $items[$i]->rate
                ]);
            }
        }

        return response()->json($itemRec);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PointOfSale  $pointOfSale
     * @return \Illuminate\Http\Response
     */
    public function show(PointOfSale $pointOfSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PointOfSale  $pointOfSale
     * @return \Illuminate\Http\Response
     */
    public function edit(PointOfSale $pointOfSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PointOfSale  $pointOfSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PointOfSale $pointOfSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PointOfSale  $pointOfSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(PointOfSale $pointOfSale)
    {
        //
    }
}
