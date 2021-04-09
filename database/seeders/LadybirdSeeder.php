<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LadybirdSeeder extends Seeder
{
    protected $permissions = [
        'group/members/read',
        'group/members/write',
        'group/descendants/read',
        'group/descendants/write',
        'group/descendant/members/read',
        'group/descendant/members/write',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPermissions();

        $this->createGroupOwner();
        $this->createGroupMember();
    }

    protected function createPermissions()
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }

    protected function createGroupOwner()
    {
        $groupOwner = Role::create(['name' => 'group_owner']);
        $groupOwner->syncPermissions(...$this->permissions);
    }

    protected function createGroupMember()
    {
        $groupMember = Role::create(['name' => 'group_member']);
        $groupMember->syncPermissions(
            'group/members/read',
            'group/descendants/read',
            'group/descendant/members/read'
        );
    }
}
