<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles): Response
    {
        $user = $request->user();

        if (!$user)
            abort(401);

        $allowed = array_map(fn($r) => Role::from($r), $roles);

        if (!$user->hasAnyRole($allowed))
            abort(403);

        return $next($request);
    }
}
