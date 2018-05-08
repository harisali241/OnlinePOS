<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company;
use Auth;

class CompanyController extends Controller
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
        $companies = company::all();
        return view ('pages.company.company',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('pages.company.addCompany');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'company_name' => "required",

            'company_address' => "required",

            'company_phoneNo' => "required",
        ]);

        if(request('status') == null){
            $status = 0;
        }else{
            $status = 1;
        }

        Company::create([

            'user_id' => Auth::user()->id,

            'company_name' => request('company_name'),

            'company_address' => request('company_address'),

            'company_phoneNo' => request('company_phoneNo'),

            'status' => $status,

        ]);

        return redirect('company/create')->with('message', 'Successfully saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = company::WHERE('id' , $id)->first();
        return view('pages.company.viewCompany',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = company::WHERE('id' , $id)->first();
        return view('pages.company.editCompany',compact('company'));
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
            'company_name' => "required",

            'company_address' => "required",

            'company_phoneNo' => "required",
        ]);

        if(request('status') == null){
            $status = 0;
        }else{
            $status = 1;
        }

        $company = Company::findOrFail($id);

        $company->company_name = request('company_name');
        $company->company_address = request('company_address');
        $company->company_phoneNo = request('company_phoneNo');
        $company->status = $status;

        $company->save();

        return redirect('company')->with('message', 'Successfully Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::Where('id', $id)->delete();
        return redirect('company')->with('message', 'Successfully Deleted');
    }
}
