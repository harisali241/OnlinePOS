<?php

namespace App\Http\Controllers;

use App\User;
use Cornford\Googlmapper\Mapper;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::fetchCompanyAdmins();
        //dd($users);
        return view ('pages.company.company',compact('users'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'company_name' => "required",

        ]);
        $company = Company::createCompany($request);

        User::createCompanyAdmin($request,$company->id);

        return redirect('company')->with('message', 'Successfully saved');

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
        $company = Company::updateCompany($request,$id);

        User::updateCompanyAdmin($request,$company->id);

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
        dd($id);
        Company::findOrFail($id)->delete();
        return redirect('company')->with('message', 'Successfully Deleted');
    }
}
