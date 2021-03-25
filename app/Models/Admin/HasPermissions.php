<?php
namespace App\Models\Admin;

use Illuminate\Support\Collection;
use Carbon\Exceptions\InvalidTypeException;
use App\Contracts\Permission;

trait HasPermissions
{
    /**
     * 全てのパーミッションを取得する
     */
    public function allPermissions(): Collection
    {
        throw 'Not implemented yet.';
    }

    /**
     * 指定したパーミッションを持っているかどうか
     *
     * @param string|App\Contracts\Permission
     * @throws InvalidTypeException
     */
    public function hasPermission($permission): bool
    {
        if (is_string($permission)) {
            return $this->allPermissions()->contains('name', $permission);
        }

        if (!($permission instanceof Permission)) {
            throw new InvalidTypeException(
                'Permission should be string or Permission.'
            );
        }

        return $this->allPermissions()->contains('id', $permission->id);
    }

    /**
     * 指定したいずれかのパーミッションを持っているかどうか
     *
     * @param string|App\Contracts\Permission
     * @throws InvalidTypeException
     */
    public function hasAnyPermission(...$permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 全てのパーミッションを持っているかどうか
     *
     * @param string|App\Contracts\Permission
     * @throws InvalidTypeException
     */
    public function hasAllPermissions(...$permissions): bool
    {
        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }
        return true;
    }
}
