<?php

namespace App\Providers;

use App\Listeners\MessageLogger;
use App\Admin\Middleware\Authorize;
use Illuminate\Support\Facades\Event;
use App\Admin\Middleware\Authenticate;
use App\Admin\Middleware\RequestLogger;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\ServiceProvider;
use App\Admin\Middleware\RedirectIfAuthenticated;
use App\Console\Commands\Admin\CreateAdministrator;

class AdminServiceProvider extends ServiceProvider
{
    protected $commands = [CreateAdministrator::class];

    protected $routeMiddleware = [
        'admin.auth' => Authenticate::class . ':admin',
        'admin.guest' => RedirectIfAuthenticated::class,
        'admin.permission' => Authorize::class,
        'log.request' => RequestLogger::class,
    ];

    protected $middlewareGroups = [
        'admin' => ['admin.auth', 'admin.permission'],
    ];

    public function register()
    {
        $this->registerRouteMiddleware();
        $this->registerMiddlewareGroups();

        Event::listen(MessageSent::class, MessageLogger::class);
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
