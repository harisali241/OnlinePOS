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
        $branches = DB::table('branches')
                    ->join('companies', 'company_id', '=', 'companies.id')
                    ->select('branches.*', 'companies.company_name')
                    ->get();
        return view ('pages.branch.branch',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *branch
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::Where('status' , 1)->get();
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

        if(request('status') == null){
            $status = 0;
        }else{
            $status = 1;
        }

        Branch::create([

            'company_id' => request('company_id'),

            'branch_name' => request('branch_name'),

            'branch_address' => request('branch_address'),

            'branch_phoneNo' => request('branch_phoneNo'),

            'status' => $status,

        ]);

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
        $branch = DB::table('branches')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->WHERE('branches.id', $id)
            ->select('branches.*', 'companies.company_name')
            ->get()->first();
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
        $branch = branch::WHERE('id' , $id)->first();
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

        if(request('status') == null){
            $status = 0;
        }else{
            $status = 1;
        }

        $branch = Branch::findOrFail($id);

        $branch->branch_name = request('branch_name');
        $branch->branch_address = request('branch_address');
        $branch->branch_phoneNo = request('branch_phoneNo');
        $branch->status = $status;

        $branch->save();

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
        Branch::Where('id', $id)->delete();
        return redirect('branch')->with('message', 'Successfully Deleted');
    }

}
