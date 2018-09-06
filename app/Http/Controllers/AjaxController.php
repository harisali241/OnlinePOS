<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function check_usernames()
    {
        $user = User::where('username','=',request()->username)->first();

        if(isset($user))
            return response()->json(0);

        else
            return response()->json(1);

    }

    public function check_usernames_edit()
    {
        $user = User::where('username','=',request()->username)
            ->where('id','!=',request()->userId)->first();

        if(isset($user))
            return response()->json(0);

        else
            return response()->json(1);

    }

    public function terminal_fetch()
    {
        $terminals = Terminal::with('branches')
            ->where('branch_id','=',request()->branch_id)->get();

        return response()->json($terminals);

    }
}
