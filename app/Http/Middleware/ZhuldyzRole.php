<?php

namespace App\Http\Middleware;

use Closure;

class ZhuldyzRole
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
        // dd(\Auth::user());
        foreach (\Auth::user()->roles()->get() as $role){

            if ($role->name == 'zhuldyz') {
                return $next($request);
            } else if ($role->name == 'raushan') {
                abort(403, "Сізде бұл парақшаға рұқсат жоқ");
            } else{
                abort(403, "Сізде бұл парақшаға рұқсат жоқ");
            }
        }
    }
}
