<?php

namespace App\Providers;

use App\Admin\Middleware\Authorize;
use App\Admin\Middleware\Authenticate;
use Illuminate\Support\ServiceProvider;
use App\Console\Commands\Admin\CreateAdministrator;

class AdminServiceProvider extends ServiceProvider
{
    protected $commands = [CreateAdministrator::class];

    protected $routeMiddleware = [
        'admin.auth' => Authenticate::class . ':admin',
        'admin.permission' => Authorize::class,
    ];

    protected $middlewareGroups = [
        'admin' => ['admin.auth', 'admin.permission'],
    ];

    public function register()
    {
        $this->registerRouteMiddleware();
        $this->registerMiddlewareGroups();
    }

    /**
     * Register the route middleware.
     */
    protected function registerRouteMiddleware(): void
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }
    }

    /**
     * Register the middleware groups.
     */
    protected function registerMiddlewareGroups(): void
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
