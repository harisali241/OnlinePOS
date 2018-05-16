<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\branch;
use Illuminate\Database\Eloquent\Model;
use DB;

class terminal extends Model
{
    protected $fillable = [
        'company_id', 'branch_id', 'terminal_name', 'terminal_address', 'terminal_phoneNo', 'status'
    ];

    public function companies()
    {
        return $this->belongsTo('App\Model\Company');
    }
    public function branches()
    {
        return $this->belongsTo('App\Model\Branch');
    }


    public static function index()
    {
        return DB::table('terminals')
            ->join('companies' , 'terminals.company_id', '=', 'companies.id')
            ->join('branches', 'branches.id', '=', 'terminals.branch_id')
            ->select('terminals.*', 'branches.branch_name', 'companies.company_name')
            ->get();
    }

    public static function getCompanies()
    {
        return Company::Where('status' , 1)->get();
    }
    public static function getBranches()
    {
        return Branch::Where('status' , 1)->get();
    }


    public static function store(Request $request)
    {
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
    }

    public static function edit($id)
    {
        return Terminal::Where('id', $id)->get()->first();
    }

    public static function show($id)
    {
        return DB::table('terminals')
            ->join('companies' , 'terminals.company_id', '=', 'companies.id')
            ->join('branches', 'branches.id', '=', 'terminals.branch_id')
            ->where('terminals.id','=', $id)
            ->select('terminals.*', 'branches.branch_name', 'companies.company_name')
            ->first();
    }

    public static function upd(Request $request, $id)
    {
        if(request('status') == null){
            $status = 0;
        }else{
            $status = 1;
        }

        $terminal = Terminal::findOrFail($id);

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
