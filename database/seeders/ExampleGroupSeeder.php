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
        $group = Group::factory()
            ->hasMembers(3)
            ->create();
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
    }
}
