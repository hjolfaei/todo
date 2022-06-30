<?php

namespace Hjolfaei\Todo\Http\Middleware;

use App\User;
use Closure;
use \Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class AuthKey
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

        #We don't need this section.(laravel auth:api middleware do this automatically)
        #For this method you need to save bearer token inside your database= table=user column=token.

        try {
            //$token = $request->bearerToken();
            $token = $request->header('Authorization');
            $token = str_ireplace('Bearer ','',$token);
            //return response()->json(["status" => $token]);
            if (!empty($token)){
                $user = \App\User::where('token', $token)->first();
                if ($user instanceof User) {
                    Auth::login($user);
                    return $next($request);
                }
            }
            return response([
                'message' => 'Unauthenticated'
            ], 403);
        }catch (Exception $e){
            return response([
                'message' => 'To use this package you most create "token" column inside your "users" table and save your user token inside created column.then use that token for header authorization.'
            ], 403);
        }






    }
}
