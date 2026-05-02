<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyHeaderAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $headerAuthorization = $request->header("Authorization");
        if (!$headerAuthorization) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el header Authorization',
                'error' => 'Token Missing'
            ], 401);
        }
        return $next($request);
    }
}
