<?php

namespace App\Http\Middleware;

use App\Models\Tokens;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoggedOut
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $authorize = $request->header("Authorization");
        $token = Tokens::where("token", $authorize)->first();
        if ($token) {
            return $next($request);
        } else {
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }
    }
}
