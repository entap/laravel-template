<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExampleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();
        $this->command->info('Add user: ' . $user->email);

        $group = Group::factory()
            ->hasMembers(3)
            ->create();
        $member = $group->assignUser($user->id);
        $member->assignRole('group_owner');
        $children = Group::factory(3)
            ->for($group, 'parent')
            ->hasMembers(3)
            ->create();
        foreach ($children as $child) {
            Group::factory(3)
                ->for($child, 'parent')
                ->hasMembers(3)
                ->create();
        }

        $this->command->info('Add group: ' . $group->id);
    }
}
