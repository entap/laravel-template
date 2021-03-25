<?php
namespace App\Models\Admin;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 操作権限
 */
class Operation extends Model
{
    use HasFactory;

    protected $table = 'admin_operations';

    protected $fillable = ['method', 'action'];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'admin_permission_operation',
            'operation_id',
            'permission_id'
        );
    }

    /**
     * Requestを通すかどうか
     */
    public function shouldPassThrough(string $method, string $action): bool
    {
        return $this->shouldActionPassThrough($action) &&
            $this->shouldMethodPassThrough($method);
    }

    private function shouldActionPassThrough(string $action): bool
    {
        if ($this->action === '/') {
            return Str::is($this->action, $action);
        }
        return Str::is($this->action, preg_replace('/^\//', '', $action));
    }

    private function shouldMethodPassThrough(string $method): bool
    {
        return Str::is(['any', $this->method], Str::lower($method));
    }
}
