<?php

namespace App\Http\Controllers;

use App\Pos;
use App\Models\Inventory;
use App\Models\PurchaseDetail;
use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Inventory::fetchInventories();

        return view('pages.sale.pos',compact('items'));
    }

    public function check(Request $request)
    {
        $id = $request->input('id');

        $items = Inventory::with('purchase_details')->where('id', '=' ,$id)->get();

        return $items;
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
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function show(Pos $pos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pos $pos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pos $pos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pos $pos)
    {
        //
    }
}
