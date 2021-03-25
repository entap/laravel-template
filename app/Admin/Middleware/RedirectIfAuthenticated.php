<?php

namespace App\Admin\Middleware;

use Closure;
use App\Facades\Admin;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (Admin::guard()->check()) {
            return redirect()->route('admin.home');
        }

        return $next($request);
    }
}
