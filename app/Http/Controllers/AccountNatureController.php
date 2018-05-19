<?php

namespace App\Http\Controllers;

use App\Models\account_nature;
use Illuminate\Http\Request;

class AccountNatureController extends Controller
{
    public function index()
    {
        $natures = account_nature::fetchAccountNatures();
        return view ('pages.nature.nature',compact('natures'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nature_name' => "required",

        ]);
        account_nature::createAccountNatures($request);

        return redirect('nature')->with('message', 'Successfully saved');
    }

    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'nature_name' => "required",

        ]);

        account_nature::updateAccountNatures($request, $id);

        return redirect('nature')->with('message', 'Successfully Edit');
    }

    public function destroy($id)
    {
        account_nature::findOrFail($id)->delete();
        return redirect('nature')->with('message', 'Successfully Deleted');
    }
}
