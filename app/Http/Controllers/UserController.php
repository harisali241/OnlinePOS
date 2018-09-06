<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Terminal;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::getUsers();
        return view('pages.users.users_list',[
            'users' => $users
        ]);
    }

    public function create()
    {
        $branches = Branch::fetchBranches();


        return view('pages.users.add_users',[
            'branches' => $branches,

        ]);
    }

    public function edit($id)
    {
        $user = User::with('branches','terminals')
        ->where('id','=',$id)->first();

        $branches = Branch::fetchBranches();
        $terminals = Terminal::where('branch_id','=',$user->branch_id)->get();

        return view('pages.users.edit_users',[
            'user' => $user,
            'branches' => $branches,
            'terminals' => $terminals
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
           'email' => 'unique:users',
           'username' => 'unique:users'
        ]);

        $user_id = User::createUsers($request,auth()->user()->company_id);

        return redirect('users')->with('message','successfully Created Users');
    }

    public function update(Request $request,$id)
    {
        $user_id = User::updateUsers($request,$id);
        return redirect('users')->with('message','successfully Created Users');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();

        return redirect('users')->with('message','Successfully Deleted Record');
    }
}
