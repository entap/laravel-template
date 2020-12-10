<?php

return [
    'include' => 'log_*_entries',

    'route' => [
        'middleware' => ['web', 'admin'],
        'prefix' => 'admin',
    ],
];
