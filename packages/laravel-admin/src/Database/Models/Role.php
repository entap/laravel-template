<?php
namespace Entap\Admin\Database\Models;

use Entap\Admin\Database\Contracts\Role as RoleContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 権限セット
 */
class Role extends Model implements RoleContract
{
    use HasFactory;
    use HasPermissions;

    protected $table = 'admin_roles';

    protected $fillable = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'admin_user_role',
            'role_id',
            'user_id'
        );
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'admin_role_permission',
            'role_id',
            'permission_id'
        );
    }

    public function allPermissions()
    {
        return $this->permissions;
    }

    public static function findByName(string $name): RoleContract
    {
        return self::where('name', $name)->first();
    }
}
