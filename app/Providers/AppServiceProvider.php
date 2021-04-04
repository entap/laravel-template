<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        AbstractPaginator::defaultView('pagination::bootstrap-4');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 設定
        $this->app->bind('settings', function () {
            return Settings::latest()->firstOrCreate(
                [],
                ['welcome_message' => 'Welcome!']
            );
        });
    }
}
