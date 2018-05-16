<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terminal;
use App\Models\Company;
use App\Models\Branch;
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
        $terminals = Terminal::index();
        return view('pages.terminal.terminal', compact('terminals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = terminal::getCompanies();
        $branches = terminal::getBranches();
        return view ('pages.terminal.addTerminal' , compact('companies','branches'));
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
            'company_id' => 'required',
            'branch_id' => 'required',
            'terminal_name' => "required",
            'terminal_code' => "required",
        ]);

        Terminal::store($request);

        return redirect('terminal/create')->with('message', 'Successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $terminal = Terminal::show($id);
        return view('pages.terminal.viewTerminal', compact('terminal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $terminal = Terminal::edit($id);
        return view('pages.terminal.editTerminal', compact('terminal'));
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
        ]);
        Terminal::upd($request, $id);
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
