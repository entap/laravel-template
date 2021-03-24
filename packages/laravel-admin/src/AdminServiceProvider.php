<?php

namespace Entap\Admin;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\ServiceProvider;
use Entap\Admin\Application\Middleware\Authorize;
use Entap\Admin\Application\Console\Commands\Seed;
use Entap\Admin\Application\Listeners\MessageLogger;
use Entap\Admin\Application\Middleware\Authenticate;
use Entap\Admin\Application\Console\Commands\Install;
use Entap\Admin\Application\Middleware\RequestLogger;
use Entap\Admin\Application\Console\Commands\CreateUser;
use Entap\Admin\Application\Middleware\RedirectIfAuthenticated;

class AdminServiceProvider extends ServiceProvider
{
    protected $commands = [CreateUser::class, Install::class, Seed::class];

    protected $routeMiddleware = [
        'admin.auth' => Authenticate::class . ':admin',
        'admin.guest' => RedirectIfAuthenticated::class,
        'admin.permission' => Authorize::class,
        'log.request' => RequestLogger::class,
    ];

    protected $middlewareGroups = [
        'admin' => ['admin.auth', 'admin.permission'],
    ];

    public function boot()
    {
        $this->publishes(
            [__DIR__ . '/../config/config.php' => config_path('admin.php')],
            'config'
        );

        $this->publishes(
            [__DIR__ . '/../public' => public_path('vendor/admin')],
            'assets'
        );

        $this->publishes(
            [
                __DIR__ . '/../resources/views/' => resource_path(
                    'views/vendor/admin'
                ),
            ],
            'views'
        );

        $this->commands($this->commands);

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'admin');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'admin');

        $this->mergeConfigAdminAuth();

        $this->registerRouteMiddleware();
        $this->registerMiddlewareGroups();

        Event::listen(MessageSent::class, MessageLogger::class);
    }

    /**
     * admin.authの設定内容をauthにも追加する
     */
    protected function mergeConfigAdminAuth()
    {
        config(Arr::dot(config('admin.auth', []), 'auth.'));
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
