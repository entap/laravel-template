<?php

return [
    'title' => 'Laravel Admin',

    'guard' => 'admin',

    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model' => Entap\Admin\Database\Models\User::class,
            ],
        ],
    ],

    'route' => [
        'prefix' => 'admin',
        'middleware' => ['web'],
    ],

    'view' => [
        'layouts' => [
            'default' => 'admin::layouts.sidebar',
            'login' => 'admin::layouts.simple',
        ],
    ],
];
