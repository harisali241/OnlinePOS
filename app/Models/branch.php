<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use DB;

class branch extends Model
{
    protected $fillable = [
        'company_id', 'branch_name', 'branch_address', 'branch_phoneNo', 'status'
    ];

    public function terminals(){
        return $this->hasMany('App\Models\Terminal' ,'branch_id');
    }
    public function companies()
    {
        return $this->belongsTo('App\Models\Company' , 'company_id');
    }
    public function vendors(){
        return $this->hasMany('App\Models\Vendor', 'branch_id');
    }

    public static function index()
    {
        return DB::table('branches')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->select('branches.*', 'companies.company_name')
            ->get();
    }

    public static function create()
    {
        return Company::Where('status' , 1)->get();
    }

    public static function store(Request $request)
    {
        if(request('status') == null){
            $status = 0;
        }else{
            $status = 1;
        }

        $branch = new Branch;

        $branch->company_id = request('company_id');
        $branch->branch_name = request('branch_name');
        $branch->branch_address = request('branch_address');
        $branch->branch_phoneNo = request('branch_phoneNo');
        $branch->status = $status;

        $branch->save();

    }

    public static function edit($id)
    {
        return branch::WHERE('id' , $id)->first();
    }

    public static function show($id)
    {
        return DB::table('branches')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->WHERE('branches.id', $id)
            ->select('branches.*', 'companies.company_name')
            ->get()->first();
    }

    public static function upd(Request $request, $id)
    {
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
    }

    public static function del($id)
    {
        Branch::Where('id', $id)->delete();
    }
}
