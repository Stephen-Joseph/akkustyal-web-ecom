<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = $request->user('admin');

        if (! $admin || $admin->role !== 'admin') {
            abort(403, 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
