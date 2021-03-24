<?php
namespace Entap\Admin;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Auth\Authenticatable;
use Entap\Admin\Application\Query\Service\MenuQueryService;

class Admin
{
    public function guard(): Guard
    {
        return Auth::guard(config('admin.guard'));
    }

    public function user(): ?Authenticatable
    {
        return $this->guard()->user();
    }

    public function routeGroup($fn)
    {
        Route::group($this->groupAttributes(), $fn);
    }

    public function menu()
    {
        if (!$this->guard()->check()) {
            return collect();
        }
        return (new MenuQueryService())->items($this->user())->toTree();
    }

    private function groupAttributes()
    {
        return [
            'prefix' => config('admin.route.prefix'),
            'middleware' => config('admin.route.middleware'),
        ];
    }
}
