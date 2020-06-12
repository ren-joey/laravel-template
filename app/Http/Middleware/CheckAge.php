<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CheckAge
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
        if ($request->age > 200 || $request->age < 0) {
            return response([
                'error' => '年齡輸入錯誤'
            ], Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
