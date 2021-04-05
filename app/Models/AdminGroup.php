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
    public function owns(GroupOwnership $ownership): bool
    {
        return $ownership->isOwnedByGroup($this);
    }
}
