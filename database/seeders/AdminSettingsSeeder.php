<?php

namespace Database\Seeders;

use App\Models\AdminPropertyType;
use Illuminate\Database\Seeder;

class AdminSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (AdminPropertyType::count() > 0) {
            return;
        }

        AdminPropertyType::create([
            'name' => 'int',
            'display_name' => '整数',
        ]);
        AdminPropertyType::create([
            'name' => 'decimal',
            'display_name' => '小数',
        ]);
        AdminPropertyType::create([
            'name' => 'string',
            'display_name' => '文字列',
        ]);
        AdminPropertyType::create([
            'name' => 'text',
            'display_name' => '複数行文字列',
        ]);
        AdminPropertyType::create([
            'name' => 'boolean',
            'display_name' => '真偽値',
        ]);
    }
}
