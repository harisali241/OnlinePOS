<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\terminal;
use App\Models\account;
use App\Models\company;
use App\Models\branch;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function home()
    {
        return view('pages.dashboard');
    }

    public function reqBranches(Request $request)
    {
        $branches =  Branch::Where('company_id' , request('id'))->get();
        return response()->json($branches);
    }
}
