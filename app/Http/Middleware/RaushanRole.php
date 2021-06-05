<?php

namespace App\Http\Middleware;

use Closure;

class RaushanRole
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
        foreach (\Auth::user()->roles()->get() as $role){

            if ($role->name == 'raushan') {
                return $next($request);
            } else if ($role->name == 'zhuldyz') {
                abort(403, "Сізде бұл парақшаға рұқсат жоқ");
            } else{
                abort(403, "Сізде бұл парақшаға рұқсат жоқ");
            }
        }
    }
}
