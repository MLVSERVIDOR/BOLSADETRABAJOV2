<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie','token' ],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://sigmun'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
