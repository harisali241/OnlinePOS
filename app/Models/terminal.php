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

    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function branches()
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }


    public static function fetchTerminals()
    {
        if(Auth::user()->role_id === 2)
        {
            $terminals = Terminal::with('branches')
                ->get();
        }
        elseif(Auth::user()->role_id === 3)
        {
            $terminals = Terminal::with('branches')
                ->where('branch_id','=',Auth::user()->branch_id)->get();
        }
        return $terminals;

        // return DB::table('terminals')
        //     ->join('companies' , 'terminals.company_id', '=', 'companies.id')
        //     ->join('branches', 'branches.id', '=', 'terminals.branch_id')
        //     ->select('terminals.*', 'branches.branch_name', 'companies.company_name')
        //     ->get();
    }


    public static function createTerminal(Request $request)
    {

        $terminal = new Terminal;

        $terminal->user_id = Auth::user()->id;
        $terminal->branch_id = request('branch_id');
        $terminal->terminal_name = request('terminal_name');
        $terminal->terminal_code = request('terminal_code');
        $terminal->status = $request['status'];
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
       $terminal->branch_id = request('branch_id');
        $terminal->terminal_name = request('terminal_name');
        $terminal->terminal_code = request('terminal_code');
        $terminal->status = $status;

        $terminal->save();
    }
}
