<?php
namespace Entap\Admin\Database\Models;

use Entap\Admin\Database\Contracts\Permission as PermissionContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 権限
 */
class Permission extends Model implements PermissionContract
{
    use HasFactory;

    protected $table = 'admin_permissions';

    protected $fillable = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'admin_user_permission',
            'permission_id',
            'user_id'
        );
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'admin_role_permission',
            'permission_id',
            'role_id'
        );
    }

    public function operations(): BelongsToMany
    {
        return $this->belongsToMany(
            Operation::class,
            'admin_permission_operation',
            'permission_id',
            'operation_id'
        );
    }

    /**
     * リクエストを通すかどうか
     */
    public function shouldPassThrough(string $method, string $action)
    {
        return $this->operations->contains(function ($operation) use (
            $method,
            $action
        ) {
            return $operation->shouldPassThrough($method, $action);
        });
    }

    public static function findByName(string $name): PermissionContract
    {
        return self::where('name', $name)->first();
    }
}
