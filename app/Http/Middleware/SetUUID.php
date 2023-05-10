<?php

namespace App\Http\Middleware;

use App\Models\TmpUsers;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;

class SetUUID
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Cookie::get('device_id') == null){
            $uuid = Uuid::uuid4();
            Cookie::queue('device_id',$uuid);
        }
        return $next($request);
    }
}
