<?php

return [
    'title' => 'Laravel Admin',

    'guard' => 'admin',

    'custom' => [
        'headers' => [
            'device' => 'X-Device-Name',
            'device_brand' => 'X-Device-Brand',
            'platform' => 'X-OS-Name',
            'platform_version' => 'X-OS-Version',
            'package_name' => 'X-Package-Name',
            'package_version' => 'X-Package-Version',
        ],
    ],

    'route' => [
        'prefix' => 'admin',
        'middleware' => ['web'],
    ],

    'view' => [
        'layouts' => [
            'default' => 'admin.layouts.app',
        ],
    ],
];
