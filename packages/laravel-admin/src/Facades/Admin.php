<?php
namespace Entap\Admin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed guard()
 * @method static mixed user()
 * @method static mixed routes()
 * @method static mixed menu()
 *
 * @see \Entap\Admin\Admin
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Entap\Admin\Admin::class;
    }
}
