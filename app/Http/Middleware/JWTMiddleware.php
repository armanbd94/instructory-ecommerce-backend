<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use stdClass;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTMiddleware extends BaseMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $response = new stdClass;
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Throwable $th) {
            if($th instanceof \Tymon\JWTAuth\Exception\TokenInvalidException)
            {
                $response->status = false;
                $response->message = "Token is invalid!";
            }elseif ($th instanceof \Tymon\JWTAuth\Exception\TokenExpiredException) {
                $response->status = false;
                $response->message = "Token is Expired!";
            }else{
                $response->status = false;
                $response->message = "Authorization token not found!";
            }
            return response()->json($response);
        }
        return $next($request);
    }
}
