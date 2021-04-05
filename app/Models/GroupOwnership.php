<?php
namespace App\Models;

/**
 * グループに所有されるリソース
 */
interface GroupOwnership
{
    /**
     * グループに所有されているかどうか
     */
    function isOwnedByGroup(AdminGroup $ownerGroup): bool;

    /**
     * グループやその先祖に所有されているかどうか
     */
    function isOwnedByGroupSelfOrAncestors(AdminGroup $ownerGroup): bool;
}
