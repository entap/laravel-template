<?php

namespace Entap\Admin\Application\Middleware;

use Closure;
use Entap\Admin\Facades\Admin;

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
