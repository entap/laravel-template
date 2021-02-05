<?php
namespace Tests\Support;

use Entap\Admin\Database\Models\Role;
use Entap\Admin\Database\Models\User;

trait HasSuperUser
{
    protected function createSuperUser()
    {
        return User::factory()
            ->has(
                Role::factory()->state(function () {
                    return ['name' => 'administrator'];
                })
            )
            ->create();
    }

    public function actingAsSuperUser($driver = 'admin')
    {
        return $this->actingAs($this->createSuperUser(), $driver);
    }
}
