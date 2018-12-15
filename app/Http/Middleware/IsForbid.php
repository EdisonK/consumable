<?php

namespace App\Http\Middleware;

use Closure;

class IsForbid
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
        $user = auth()->user();
        if($user->isForbid()){
            return response('该用户已被禁止登陆,请联系管理员开启账户，电话：15895348728（朱先生）');
        }
        return $next($request);
    }
}
