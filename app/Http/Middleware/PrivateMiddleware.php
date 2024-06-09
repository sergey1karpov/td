<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Models\ListUsers;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PrivateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->route()->parameter('user');

        if(Auth::id() == $user->id) {
            return $next($request);
        }

        abort(Response::HTTP_NOT_FOUND);
    }
}
