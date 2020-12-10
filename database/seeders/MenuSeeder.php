<?php

namespace Database\Seeders;

use Entap\Admin\Database\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuItem::create([
            'title' => '一般ユーザー',
            'uri' => route('admin.users.index', null, false),
        ]);
    }
}
