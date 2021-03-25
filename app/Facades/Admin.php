<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed guard()
 * @method static mixed user()
 * @method static mixed routes()
 * @method static mixed menu()
 *
 * @see \App\Admin
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Admin::class;
    }
}
