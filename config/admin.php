<?php

return [
    'title' => 'Laravel Admin',

    'view' => [
        'layouts' => [
            'default' => 'admin::layouts.sidebar',
        ],
    ],

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
];
