<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if(!auth()->user()->hasRole($role)) {
        //if(!Auth::user()->hasRole($role)) {
            abort(404);
        }
        if($permission !== null && !auth()->user()->can($permission)) {
        //if($permission !== null && !Auth::user()->can($permission)) {
            abort(404);
        }
        return $next($request);
    }
}
