<?php

namespace App\Http\Controllers;

use App\Models\PointOfSale;
use Illuminate\Http\Request;
use App\Models\GRNMaster;
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
        //dd($request->item);
        if(Auth::user()->branch_id == null){
            $items = GRNMaster::where('company_id', Auth::user()->company_id)
                                ->where('total_balance', 0)
                                ->with(['g_r_n_details.inventories' => function($eq){
                                    $eq->where('item_name', 'like' ,'%'.$request->item.'%');
                                }])
                                ->get();
        }else{
            $items = GRNMaster::where('company_id', Auth::user()->company_id)
                                ->where('branch_id', Auth::user()->branch_id)
                                ->where('total_balance', 0)
                                ->with(['g_r_n_details' => function($eq){
                                    $eq->where('inventory_id', 'like' ,'%'.$request->item.'%');
                                }])
                                ->get();
        };
        return response()->json($items);
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
