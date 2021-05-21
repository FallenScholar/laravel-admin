<?php

return [
    'route' => [

        'prefix' => env('API_ROUTE_PREFIX', 'api'),

        'namespace' => 'App\\Http\\Controllers\\Api',

        'middleware' => ['api'],
    ],
];
