<?php

namespace App\Models;

use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * 管理グループ
 */
class AdminGroup extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $fillable = ['name', 'parent_id'];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'admin_group_user',
            'admin_group_id',
            'admin_user_id'
        );
    }

    /**
     * リソースを所有しているか
     */
    public function owns(GroupOwnership $resource): bool
    {
        return $resource->isOwnedByGroupSelfOrAncestors($this);
    }
}
