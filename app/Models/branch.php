<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use DB;

class Branch extends Model
{
    protected $fillable = [
        'company_id', 'branch_name', 'branch_phoneNo', 'status'
    ];

    public function Terminals(){
        return $this->hasMany('App\Models\Terminal' ,'branch_id');
    }
    public function companies()
    {
        return $this->belongsTo('App\Models\company' , 'company_id');
    }
    /*public function Vendors(){
        return $this->hasMany('App\Models\Vendor', 'branch_id');
    }
    public function Customers(){
        return $this->hasMany('App\Models\Customer', 'branch_id');
    }
    public function Accounts(){
        return $this->hasMany('App\Models\Account', 'branch_id');
    }*/
    public function users(){
        return $this->hasMany('App\User');
    }


    public static function fetchBranches()
    {
        $branches = branch::where('company_id','=',auth()->user()->company_id)->get();
        //dd($branches);
        return $branches;
    }


    public static function createBranch($request)
    {
        $branch = new Branch;

        $branch->company_id = $request['company_id'];
        $branch->branch_name = $request['branch_name'];
        $branch->branch_phoneNo = $request['branch_phoneNo'];
        $branch->status = $request['status'];
        $branch->location = $request['location'];
        $branch->latitude = $request['latitude'];
        $branch->longitude = $request['longitude'];
        $branch->save();

    }


    public static function updateBranch($request, $id)
    {

        $branch = Branch::findOrFail($id);

        $branch->company_id = $request['company_id'];
        $branch->branch_name = $request['branch_name'];
        $branch->branch_phoneNo = $request['branch_phoneNo'];
        $branch->status = $request['status'];
        $branch->location = $request['location'];
        $branch->latitude = $request['latitude'];
        $branch->longitude = $request['longitude'];

        $branch->save();
    }
}
