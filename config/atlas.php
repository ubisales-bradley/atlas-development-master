<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Inital Users to be seeded
    |--------------------------------------------------------------------------
     */
    'initialUsers' => [
        'admin' => [
            'user01Enabled'                       => env('INITIAL_SEEDED_ADMIN_ENABLED', false),
            'user01FirstName'                     => env('INITIAL_SEEDED_ADMIN_USER_FIRSTNAME', null),
            'user01LastName'                      => env('INITIAL_SEEDED_ADMIN_USER_LASTNAME', null),
            'user01Email'                         => env('INITIAL_SEEDED_ADMIN_USER_EMAIL', null),
            'user01PW'                            => env('INITIAL_SEEDED_ADMIN_USER_PASSWORD', null),
        ],
        'registered' => [
            'user01Enabled'                       => env('INITIAL_SEEDED_REGISTERED_ENABLED', false),
            'user01FirstName'                     => env('INITIAL_SEEDED_REGISTERED_USER_FIRSTNAME', null),
            'user01LastName'                      => env('INITIAL_SEEDED_REGISTERED_USER_LASTNAME', null),
            'user01Email'                         => env('INITIAL_SEEDED_REGISTERED_USER_EMAIL', null),
            'user01PW'                            => env('INITIAL_SEEDED_REGISTERED_USER_PASSWORD', null),
        ],
    ],
];
