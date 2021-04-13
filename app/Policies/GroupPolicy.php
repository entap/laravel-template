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

    public function readMember(User $user, Group $group)
    {
        $member = $group->getUser($user->id);
        return optional($member)->hasPermissionTo('group/members/read');
    }

    public function writeMember(User $user, Group $group)
    {
        $member = $group->getUser($user->id);
        return optional($member)->hasPermissionTo('group/members/write');
    }

    public function readDescendantGroup(User $user, Group $group)
    {
        // FAKE IT
        return false;
    }

    public function writeDescendantGroup(User $user, Group $group)
    {
        // FAKE IT
        return false;
    }

    public function readDescendantMember(User $user, Group $group)
    {
        // FAKE IT
        return false;
    }

    public function writeDescendantMember(User $user, Group $group)
    {
        $member = $group->getUser($user->id);
        return optional($member)->hasPermissionTo(
            'group/descendant/members/write'
        );
    }
}
