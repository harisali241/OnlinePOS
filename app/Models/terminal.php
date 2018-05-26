<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\branch;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Terminal extends Model
{
    protected $fillable = [
        'user_id', 'branch_id', 'terminal_name','terminal_code', 'status'
    ];

    public function Users()
    {
        return $this->belongsTo('App\User');
    }
    public function branches()
    {
        return $this->belongsTo('App\Models\Branch');
    }


    public static function fetchTerminals()
    {
        $terminals = Terminal::all();
        return $terminals;

        // return DB::table('terminals')
        //     ->join('companies' , 'terminals.company_id', '=', 'companies.id')
        //     ->join('branches', 'branches.id', '=', 'terminals.branch_id')
        //     ->select('terminals.*', 'branches.branch_name', 'companies.company_name')
        //     ->get();
    }


    public static function createTerminal(Request $request)
    {
        if(request('status') == 0){
            $status = 0;
        }else{
            $status = 1;
        }

        $terminal = new Terminal;

        $terminal->user_id = Auth::user()->id;
        $terminal->branch_id = Auth::user()->branch_id;
        $terminal->terminal_name = request('terminal_name');
        $terminal->terminal_code = request('terminal_code');
        $terminal->status = $status;
        $terminal->save();
    }

    

    public static function updateTerminal(Request $request, $id)
    {
        if(request('status') == 0){
            $status = 0;
        }else{
            $status = 1;
        }

        $terminal = Terminal::findOrFail($id);

        $terminal->user_id = Auth::user()->id;
        $terminal->branch_id = Auth::user()->branch_id;
        $terminal->terminal_name = request('terminal_name');
        $terminal->terminal_code = request('terminal_code');
        $terminal->status = $status;

        $terminal->save();
    }

    public static function del($id)
    {
        Terminal::Where('id', $id)->delete();
    }
}
