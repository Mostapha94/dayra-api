<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['response'=>['status' => false ,'code' => 401 ,'message'=>  __('This action require login') ]], 401 );
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['response'=>['status' => false ,'code' => 401 ,'message'=>  __('Your login expired , login again') ]], 401 );
            }else{
                return response()->json(['response'=>['status' => false ,'code' => 401 ,'message'=>  __('Some thing went wrongs verify that you are loged in!') ]], 401 );
            }
        }
        return $next($request);
    }
}
