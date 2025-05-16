<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddHeadersToResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

//        if($response->headers->has('pp-Cat')) {
//            $response->headers->set('pp-Cat', 'update');
//        }
//        else
//            $response->headers->set('pp-Cat', 'no update');

        return $response;
    }
}
