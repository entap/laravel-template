<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function writeMember(User $user, Group $group)
    {
        $member = $group->getUser($user->id);
        return optional($member)->hasPermissionTo('group/members/write');
    }

    public function writeDescendantMember(
        User $user,
        Group $group,
        Group $descendant
    ) {
        if (!$group->descendants->contains('id', $descendant->id)) {
            return false;
        }

        $member = $group->getUser($user->id);
        return optional($member)->hasPermissionTo(
            'group/descendant/members/write'
        );
    }
}
