<?php

namespace App\Http\Middleware;

use App\AdminmenuPremit;
use Closure;
use Auth;
use Request;

class RedirectCompanyAdmin
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
        if(Auth::user()->role_id === 2)
        {

            $adminpermit = AdminmenuPremit::where('status','=',1)->get();

            $arr = [];

            foreach ($adminpermit as $value) {

                array_push($arr, $value->route);
            }
            $data = in_array(Request::route()->getName(), $arr);
            //dd($arr);
            if(!$data)
            {
                return abort(404);
            }
            else
            {
                return $next($request);
            }

        }
        else
        {
            return $next($request);
        }

    }
}
