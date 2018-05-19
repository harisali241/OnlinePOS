<?php

namespace App\Models;

use Illuminate\Http\Request;
use auth;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $fillable = [
        'user_id', 'company_name', 'company_address', 'company_phoneNo', 'status'
    ];

    public function branches(){
        return $this->hasMany('App\Models\Branch', 'company_id');
    }
    public function terminals(){
        return $this->hasMany('App\Models\Terminal', 'company_id');
    }
    public function vendors(){
        return $this->hasMany('App\Models\Vendor', 'company_id');
    }
    public function accounts(){
        return $this->hasMany('App\Models\Account', 'company_id');
    }


    public static function fetchCompanies(){
        return company::all();
    }

    public static function createCompany(Request $request){

        if(request('status') == null){
            $status = 0;
        }else{
            $status = 1;
        }

        Company::create([

            'user_id' => Auth::user()->id,

            'company_name' => request('company_name'),

            'company_address' => request('company_address'),

            'company_phoneNo' => request('company_phoneNo'),

            'status' => $status,

        ]);

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
