<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$roles): Response
    {
        if(Auth::check())
        {
            $role=Auth::user()->role;
            $hasAcess=in_array($role,$roles);

            if(!$hasAcess)
            {
                abort(403);
            }
        }
        
        //Other than that proceed
        return $next($request);
    }

}
