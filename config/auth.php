<?php

use App\Models\Account;

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication guard that will be
    | used by the framework when resolving the currently authenticated user.
    |
    */

    'defaults' => [
        'guard' => 'web',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | You may define every authentication guard for your application here.
    | The session guard is enough for this app because authentication is
    | handled through standard web sessions and cookies.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'accounts',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | User providers define how users are actually retrieved out of your
    | persistent storage. This application authenticates against the
    | accounts table through the dedicated Account model.
    |
    */

    'providers' => [
        'accounts' => [
            'driver' => 'eloquent',
            'model' => Account::class,
        ],
    ],
];
