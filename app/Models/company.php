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

    public static function createCompany($data){


        $company = new Company;


        $company->company_name = $data['company_name'];
        $company->location = $data['location'];
        $company->latitude = $data['latitude'];
        $company->longitude = $data['longitude'];

        $company->save();

        return $company;

    }


    public static function updateCompany($data, $id){


        $company = Company::findOrFail($id);

        $company->company_name = $data['companies']['company_name'];
        $company->location = $data['companies']['location'];
        $company->latitude = $data['companies']['latitude'];
        $company->longitude = $data['companies']['longitude'];

        $company->save();

        return $company;
    }
}
