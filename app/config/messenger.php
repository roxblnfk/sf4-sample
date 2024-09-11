<?php

declare(strict_types=1);

return [
    'interceptors' => [
        'inbound' => [
            \App\Application\Interceptor\DumpInterceptor::class,
        ],
        'outbound' => [
            \App\Application\Interceptor\DumpInterceptor::class,
        ],
    ],
];
