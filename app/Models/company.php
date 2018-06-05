<?php

namespace App\Models;

use Illuminate\Http\Request;
use auth;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name', 'company_address', 'company_phoneNo', 'status'
    ];

    public function branches(){
        return $this->hasMany('App\Models\branch');
    }
    
    public function users(){
        return $this->hasMany('App\User');
    }


    public static function fetchCompanies(){
        return company::all();
    }

    public static function createCompany(Request $Request){

        if(request('status') == 0){
            $status = 0;
        }else{
            $status = 1;
        }
        $company = new Company;

        $company->user_id = Auth::user()->id;
        $company->company_name = request('company_name');
        $company->company_address = request('company_address');
        $company->company_phoneNo = request('company_phoneNo');
        $company->status = $status;

        $company->save();


    }


    public static function updateCompany($request, $id){


        $company = Company::findOrFail($id);

        $company->company_name = $request['company_name'];
        $company->company_address = $request['company_address'];
        $company->company_phoneNo = $request['company_phoneNo'];
        $company->status = $request['status'];

        $company->save();
    }
}
