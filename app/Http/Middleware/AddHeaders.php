<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->header('X-Frame-Options', 'deny');
        $response->header('Strict-Transport-Security', 'max-age=63072000; includeSubDomains; preload');
        $response->header('X-XSS-Protection', '1; mode=block');
        $response->header('Accept-Encoding', 'gzip, deflate');
        //$response->header('Content-Encoding', 'gzip');
        $response->header('Cache-Control', 'max-age=86400');
        $response->header('Content-Type', 'text/html');
        $response->header('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}
