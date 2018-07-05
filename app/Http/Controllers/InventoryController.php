<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\inventory;
use App\Models\account;

use DB;
use Illuminate\Support\Facades\Route;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Route::getRoutes());
        $inventories = Inventory::fetchInventories();
        $accounts = Account::fetchAccounts();
        $branches = Branch::fetchBranches();
        //$userBranch = Inventory::fetchUserBranch();
        return view('pages.inventory.inventory', compact('inventories','accounts','branches'));
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
        //dd($request);
        $request->validate([
            'item_name' => "required",
            'item_desc' => "required",
            'opening_qty' => "required",
            'alert_qty' => "required",
            'account_id' => "required",
            'branch_id' => "required",
            'company_id' => "required",
            'status' => "required",
        ]);
        Inventory::createInventory($request);
        return redirect('inventory')->with('message', 'Successfully saved');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'item_name' => "required",
            'item_desc' => "required",
            'opening_qty' => "required",
            'alert_qty' => "required",
            'status' => "required",
        ]);

        Inventory::updateInventory($request, $id);

        return redirect('inventory')->with('message', 'Successfully Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        Inventory::findOrFail($id)->delete();
        return redirect('inventory')->with('message', 'Successfully Deleted');
    }
}
