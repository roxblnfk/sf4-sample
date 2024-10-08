<?php

declare(strict_types=1);

/**
 * Configuration for gRPC.
 *
 * @link https://spiral.dev/docs/grpc-configuration#configuration
 */

use Spiral\Grpc\Client\Config\ConnectionConfig;
use Spiral\Grpc\Client\Config\GrpcClientConfig;
use Spiral\Grpc\Client\Interceptor\ExecuteServiceInterceptors;
use Spiral\Grpc\Client\Interceptor\RetryInterceptor;
use Spiral\Grpc\Client\Interceptor\SetTimoutInterceptor;

return [
    /**
     * Path, where generated DTO files put.
     * Default: null
     */
    'generatedPath' => directory('app') . '/generated',

    /**
     * Base namespace for generated proto files.
     * Default: null
     */
    'namespace' => 'GRPC',

    /**
     * Paths to proto files, that should be compiled into PHP by "grpc:generate" console command.
     */
    'services' => [
        directory('app') . 'proto/google/timestamp.proto',
        directory('app') . 'proto/mailer/service.proto',
        directory('app') . 'proto/pinger/service.proto',
    ],

    /**
     * Root path for all proto files in which imports will be searched.
     * Default: null
     */
    'servicesBasePath' => directory('app') . '/proto',

    'client' => new GrpcClientConfig(
        interceptors: [
            SetTimoutInterceptor::createConfig(6_000),
            RetryInterceptor::createConfig(
                maximumAttempts: 1,
            ),
            ExecuteServiceInterceptors::class,
        ],
        services: [
            new \Spiral\Grpc\Client\Config\ServiceConfig(
                connections: ConnectionConfig::createInsecure('localhost:9001'),
                interfaces: [
                    \GRPC\Mailer\MailerServiceInterface::class
                ],
            ),
        ],
    )
];
