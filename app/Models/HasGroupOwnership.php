<?php
namespace App\Models;

use App\Models\AdminGroup;

/**
 * グループに所有される
 */
trait OwnedByGroup
{
    /**
     * 所有グループ
     */
    public function ownerGroup()
    {
        return $this->belongsTo(AdminGroup::class, 'owner_group_id');
    }

    /**
     * グループに所有されているか
     */
    public function isOwnedByGroup(AdminGroup $ownerGroup): bool
    {
        return $this->ownerGroup->id === $ownerGroup->id;
    }

    /**
     * グループまたはその先祖に所有されているか
     */
    public function isOwnedByGroupSelfOrAncestors(AdminGroup $ownerGroup): bool
    {
        return $this->isOwnedByGroup($ownerGroup) ||
            $this->ownerGroup->isDescendantOf($ownerGroup);
    }
}
