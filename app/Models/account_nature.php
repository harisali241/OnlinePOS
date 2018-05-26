<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use auth;

class Account_nature extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'nature_id';

    protected $table = 'account_nature';

    protected $fillable = [
        'nature_name'
    ];

    public function Accounts(){
        return $this->hasMany('App\Models\Account', 'nature_id');
    }

    public static function fetchAccountNatures()
    {
        return account_nature::all();
    }

    public static function createAccountNatures(Request $request){


        account_nature::create([


            'nature_name' => request('nature_name'),

        ]);

    }

    public static function updateAccountNatures($request, $id){


        $nature = account_nature::findOrFail($id);

        $nature->nature_name = $request['nature_name'];


        $nature->save();
    }
}
