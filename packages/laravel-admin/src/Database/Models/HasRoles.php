<?php
namespace Entap\Admin\Database\Models;

use Illuminate\Support\Collection;
use Entap\Admin\Database\Contracts\Role;
use Carbon\Exceptions\InvalidTypeException;

trait HasRoles
{
    /**
     * 全てのロールを取得する
     */
    public function allRoles(): Collection
    {
        throw 'Not implemented yet.';
    }

    /**
     * ロールを持っているかどうか
     *
     * @param string|Entap\Admin\Database\Contracts\Role $role
     * @throws InvalidTypeException
     */
    public function hasRole($role): bool
    {
        if (is_string($role)) {
            return $this->allRoles()->contains('name', $role);
        }

        if (!($role instanceof Role)) {
            throw new InvalidTypeException('Role should be string or Role.');
        }

        return $this->roles()->contains('id', $role->id);
    }

    /**
     * いずれかのロールを持っているかどうか
     *
     * @param string|Entap\Admin\Database\Contracts\Role ...$roles
     * @throws InvalidTypeException
     */
    public function hasAnyRole(...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 全てのロールを持っているかどうか
     *
     * @param string|Entap\Admin\Database\Contracts\Role ...$roles
     * @throws InvalidTypeException
     */
    public function hasAllRoles(...$roles): bool
    {
        foreach ($roles as $role) {
            if (!$this->hasRole($role)) {
                return false;
            }
        }
        return true;
    }

    /**
     * 特別な管理者かどうか
     */
    public function isAdministrator()
    {
        // TODO Permission工夫したら要らないかも
        return $this->hasRole('administrator');
    }
}
