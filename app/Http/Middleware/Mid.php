<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class Mid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $req, Closure $next)
    {
        $api_token = $req->header('api_token');

        if (!$api_token)
            return response()->json("Не введен api_token");
        
        if (!User::where('api_token', $api_token)->first())
            return response()->json("Такого пользователя не существует");
        return $next($req);
    }
}
