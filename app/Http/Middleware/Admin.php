<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class Admin
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
        $token = $req->header('api_token');
        $users = User::where('api_token', $token)->where('type', 'admin')->first();

        if (!$users)
        {
            return response()->json("Вам отказано в доступе.");
        }

        return $next($req);
    }
}
