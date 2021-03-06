<?php

use App\AdminmenuPremit;
use App\Menu;
use App\Models\Account;
use App\Models\Terminal;
use App\Permission;
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


function createUserPermission()
{
    $old_menus = Menu::all();

    foreach ($old_menus as $old)
    {
        Menu::findOrFail($old->id)->delete();
    }

    $routes = Route::getRoutes();

    $systemroutes = [];
    foreach ($routes as $route)
    {

        if(isset($route->action['as']))
            array_push($systemroutes,$route->action['as']);

    }
    //dd($systemroutes);

    for ($i = 0; $i < sizeof($systemroutes); $i++)
    {
        $menu = new Menu;

        $menu->menu_route = $systemroutes[$i];
        $menu->sort_order = $i+1;


        $menu->save();
    }
}

function get_parent_menus_permission()
{
    $menus = Menu::where('status','=',1)
        ->where('parent_menu_id','=',null)
        ->orderBy('sort_order','asc')->get();

    return $menus;
}

function get_child_menus_permission($parent_menu_id)
{
    $menus = Menu::where('status','=',1)
        ->where('parent_menu_id','=',$parent_menu_id)
        ->orderBy('sort_order','asc')->get();

    return $menus;
}

function getAccountOfBranches($branchId)
{
    $edit_accounts = account::where('branch_id','=',$branchId)->pluck('account_name','id');

    return json_decode($edit_accounts);
}

function parent_menu()
{
    $permission = Permission::with('menus')
        ->where('status', '=', 1)
        ->where('user_id', '=', auth()->user()->id)->get()->where('menus.parent_menu_id','=',null);


    return $permission;
}

function child_menu($parent_id)
{
    $permission = Permission::with('menus')
        ->where('status', '=', 1)
        ->where('user_id', '=', auth()->user()->id)->get()
        ->where('menus.parent_menu_id','=',$parent_id)
        ->where('menus.status','=',1)
        ->where('menus.hidden','=',0);

    if(sizeof($permission) < 1)
    {
        $data = [
            'is_child' => false,
            'data' => $permission
        ];
    }
    else
    {
        $data = [
            'is_child' => true,
            'data' => $permission
        ];
    }

    return $data;
}