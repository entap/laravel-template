<?php

namespace Database\Seeders;

use App\Models\Group;
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
        $groups = Group::factory(5)->create();
        $children = Group::factory(15)->state(function () use ($groups) {
            return [
                'parent_id' => $groups->random()->id,
            ];
        })->create();
        Group::factory(15)->state(function () use ($children) {
            return [
                'parent_id' => $children->random()->id,
            ];
        })->create();
    }
}
