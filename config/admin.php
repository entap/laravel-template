<?php

return [
  'title' => 'Laravel Admin',

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
