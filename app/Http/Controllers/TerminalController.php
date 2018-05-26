<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terminal;
use App\Models\Company;
use App\Models\Branch;
use App\User;
use DB;

class TerminalController extends Controller
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
        $terminals = Terminal::fetchTerminals();
        $company = User::fetchCompanyFromUser();
        $branch = User::fetchBranchFromUser();
        return view('pages.terminal.terminal', compact('terminals', 'company', 'branch'));
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
        //return $request->all();
        $this->validate(request(), [
            'terminal_name' => "required",
            'terminal_code' => "required",
            'status' => "required"
        ]);

        Terminal::createTerminal($request);

        return redirect('terminal')->with('message', 'Successfully saved');
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
        $this->validate(request(),[
            'terminal_name' => "required",
            'terminal_code' => "required",
            'status' => "required"
        ]);
        Terminal::updateTerminal($request, $id);
        return redirect('terminal')->with('message', 'Successfully Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Terminal::del($id);
        return redirect('terminal')->with('message', 'Successfully Deleted');
    }
}
