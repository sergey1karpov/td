<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Models\ListUsers;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ShowListMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id = Auth::id();
        $list = $request->route()->parameter('list');

        $role = ListUsers::where('user_id', $user_id)->where('list_id', $list->id)->first();

        if(!$role || $role->role == RoleEnum::Close->value) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
