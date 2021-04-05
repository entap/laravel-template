<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * プロジェクト
 */
class Project extends Model implements GroupOwnership
{
    use HasFactory;

    public function ownerGroup()
    {
        return $this->belongsTo(AdminGroup::class, 'owner_group_id');
    }

    /**
     * グループに所有されているか
     */
    public function isOwnedByGroup(AdminGroup $ownerGroup): bool
    {
        return $this->ownerGroup->id === $ownerGroup->id ||
            optional($ownerGroup->parent)->owns($this);
    }
}
