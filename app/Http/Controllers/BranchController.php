<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Company;
use DB;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $branches = Branch::index();
        return view ('pages.branch.branch',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *branch
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Branch::create();
        return view ('pages.branch.addBranch' , compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return request()->all();

        $this->validate(request(), [
            'company_id' => 'required',
            'branch_name' => "required",
            'branch_address' => "required",
            'branch_phoneNo' => "required",
        ]);
        Branch::store($request);
        return redirect('branch/create')->with('message', 'Successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::show($id);
        return view ('pages.branch.viewBranch',compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::edit($id);
        return view('pages.branch.editBranch',compact('branch'));
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
        $this->validate(request(), [
            'branch_name' => "required",
            'branch_address' => "required",
            'branch_phoneNo' => "required",
        ]);
        Branch::upd($request, $id);
        return redirect('branch')->with('message', 'Successfully Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::del($id);
        return redirect('branch')->with('message', 'Successfully Deleted');
    }

}
