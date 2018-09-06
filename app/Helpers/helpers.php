<?php

use App\AdminmenuPremit;
use App\Models\Account;
use App\Models\Terminal;
use Illuminate\Support\Facades\Route;

/**
 * @param $role_id
 */
function createAdminPermission()
{
    $routes = Route::getRoutes();

    $permissions = AdminmenuPremit::where('role_id','=',2)->get();

    $regroutes = [];

    foreach ($permissions as $permission)
    {
        array_push($regroutes,$permission->route);
    }

    $systemroutes = [];
    foreach ($routes as $route)
    {
        if(isset($route->action['as']))
            array_push($systemroutes,$route->action['as']);

    }
    $mergedRoute = array_unique(array_merge($regroutes,$systemroutes));

    foreach ($permissions as $per)
    {
        AdminmenuPremit::findOrFail($per->id)->delete();
    }

    for ($i = 0; $i < sizeof($mergedRoute); $i++)
    {
        $permit = new AdminmenuPremit;

        $permit->role_id = 2;
        $permit->route = $mergedRoute[$i];
        $permit->status = 1;

        $permit->save();
    }
}

function getAccountOfBranches($branchId)
{
    $edit_accounts = account::where('branch_id','=',$branchId)->pluck('account_name','id');

    return json_decode($edit_accounts);
}