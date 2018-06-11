<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Terminal;
use App\Models\Company;
use App\Models\Branch;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'branch_id', 'company_id','firstName','lastName', 'address','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function companies()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }

    public function branches()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public static function createCompanyAdmin($data,$company_id){

        $user = new User;
        $user->firstName = $data['firstName'];
        $user->lastName = $data['lastName'];
        $user->role_id = 2;
        $user->company_id = $company_id;
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->phoneNo = $data['phoneNo'];
        $user->status = $data['status'];
        $user->password = bcrypt($data['password']);

        $user->save();
    }

    public static function updateCompanyAdmin($data,$company_id){

        $user = User::findOrFail($data['user_id']);

        $user->firstName = $data['firstName'];
        $user->lastName = $data['lastName'];
        $user->role_id = 2;
        $user->company_id = $company_id;
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->phoneNo = $data['phoneNo'];
        $user->status = $data['status'];

        if($data['password'] !== null)
            $user->password = bcrypt($data['password']);

        $user->save();
    }

    public static function fetchCompanyAdmins(){

        $users = User::with('companies')
            ->Where('role_id' , '=',2)->get();

        return $users;
    }

    public static function fetchCompanyFromUser(){
        $company = Company::Where('id' , Auth::user()->company_id)->pluck('company_name')[0];
        return $company;
    }
    public static function fetchBranchFromUser(){
        $branch = Branch::Where('id' , Auth::user()->branch_id)->pluck('branch_name')[0];
        return $branch;
    }

}
