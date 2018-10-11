<?php

namespace App\Http\Middleware;

use App\Permission;
use Closure;

class UserPermissionsCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role_id > 2 ) {
            if($request->route()->getName() !== 'home') {

                $permission = Permission::with('menus')
                    ->where('status', '=', 1)
                    ->where('user_id', '=', auth()->user()->id)->get()->pluck('menus.menu_route')->toArray();


                $permit = in_array($request->route()->getName(), $permission);

                if (!$permit) {
                    return abort(404);
                }
            }
        }

        return $next($request);
    }
}
