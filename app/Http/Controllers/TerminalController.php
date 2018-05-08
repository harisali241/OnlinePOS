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
        $terminals = DB::table('terminals')
                    ->join('companies' , 'terminals.company_id', '=', 'companies.id')
                    ->join('branches', 'branches.id', '=', 'terminals.branch_id')
                    ->select('terminals.*', 'branches.branch_name', 'companies.company_name')
                    ->get();
        return view('pages.terminal.terminal', compact('terminals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::Where('status' , 1)->get();
        $branches = Branch::Where('status' , 1)->get();
        return view ('pages.terminal.addTerminal' , compact('companies','branches'));
    }

    public function reqBranches(request $request){
        $branches = Branch::Where('company_id' , request('id'))->get();

        return response()->json($branches);
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

        if(request('status') == null){
            $status = 0;
        }else{
            $status = 1;
        }

        $terminal = new Terminal;

        $terminal->company_id = request('company_id');
        $terminal->branch_id = request('branch_id');
        $terminal->terminal_name = request('terminal_name');
        $terminal->terminal_code = request('terminal_code');
        $terminal->status = $status;
        $terminal->save();

//        Terminal::create([
//
//            'company_id' => request('company_id'),
//
//            'branch_id' => request('branch_id'),
//
//            'terminal_name' => request('terminal_name'),
//
//            'terminal_code' => request('terminal_code'),
//
//            'status' => $status,
//
//        ]);

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
        $terminal = DB::table('terminals')
            ->join('companies' , 'terminals.company_id', '=', 'companies.id')
            ->join('branches', 'branches.id', '=', 'terminals.branch_id')
            ->where('terminals.id','=', $id)
            ->select('terminals.*', 'branches.branch_name', 'companies.company_name')
            ->first();
        //dd($terminal);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Terminal::Where('id', $id)->delete();
        return redirect('terminal')->with('message', 'Successfully Deleted');
    }
}
