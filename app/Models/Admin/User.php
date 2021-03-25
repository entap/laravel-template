<?php
namespace App\Models\Admin;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * 管理ユーザー
 */
class User extends Model implements UserContract
{
    use Authenticatable;
    use HasFactory;
    use HasRoles;
    use HasPermissions;

    protected $table = 'admin_users';

    protected $fillable = ['username', 'password', 'name'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'admin_user_role',
            'user_id',
            'role_id'
        );
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'admin_user_permission',
            'user_id',
            'permission_id'
        );
    }

    public function groups()
    {
        return $this->belongsToMany(
            UserGroup::class,
            'admin_user_group_user',
            'user_id',
            'group_id'
        );
    }

    public function can(string $permission): bool
    {
        return $this->hasPermission($permission);
    }

    public function cannot(string $permission): bool
    {
        return !$this->hasPermission($permission);
    }

    public function allRoles(): Collection
    {
        return $this->roles;
    }

    /**
     * Roleの下のPermissionsも含めた全てのPermissions
     */
    public function allPermissions(): Collection
    {
        // これちょっと重いか
        return $this->roles()
            ->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->merge($this->permissions);
    }

    public function hasOperation(string $method, string $action)
    {
        return $this->allPermissions()->contains(function ($p) use (
            $method,
            $action
        ) {
            return $p->shouldPassThrough($method, $action);
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->groups()->detach();
        });
    }
}
