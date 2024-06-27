<?php

declare(strict_types=1);

namespace GRPC\Bootloader;

use GRPC\Config\GRPCServicesConfig;
use GRPC\Ping\PingServiceClient;
use GRPC\Ping\PingServiceInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\EnvironmentInterface;
use Spiral\Config\ConfiguratorInterface;
use Spiral\Core\Container;
use Spiral\Core\InterceptableCore;
use Spiral\RoadRunnerBridge\GRPC\Interceptor\ServiceClientCore;

/**
 * Automatically generated bootloader by GRPC services generator.
 * It uses only in case of you need make requests to GRPC services from your application.
 *
 * It registers all GRPC services interfaces as a clients in the container and env variables with service hosts.
 * @see PING_SERVICE_HOST env variable in .env file.
 */
final class ServiceBootloader extends Bootloader
{
    public function __construct(public ConfiguratorInterface $config)
    {
    }

    public function init(EnvironmentInterface $env): void
    {
        $this->initConfig($env);
    }

    public function boot(Container $container): void
    {
        $this->initServices($container);
    }

    /**
     * Don't edit this method manually, it is generated by GRPC services generator.
     */
    private function initConfig(EnvironmentInterface $env): void
    {
        $this->config->setDefaults(
            GRPCServicesConfig::CONFIG,
            [
                'services' => [
                    PingServiceClient::class => ['host' => $env->get('PING_SERVICE_HOST', '127.0.0.1:9000')],
                ],
            ]
        );
    }

    /**
     * Don't edit this method manually, it is generated by GRPC services generator.
     */
    private function initServices(Container $container): void
    {
        $container->bindSingleton(
            PingServiceInterface::class,
            static function (GRPCServicesConfig $config): PingServiceInterface {
                $service = $config->getService(PingServiceClient::class);

                return new PingServiceClient(
                    new InterceptableCore(new ServiceClientCore(
                        $service['host'],
                        ['credentials' => $service['credentials'] ?? $config->getDefaultCredentials()]
                    ))
                );
            }
        );
    }
}