<?php

declare(strict_types=1);

namespace GRPC\Bootloader;

use GRPC\Config\GRPCServicesConfig;
use GRPC\Mailer\MailerServiceClient;
use GRPC\Mailer\MailerServiceInterface;
use GRPC\Ping\PingServiceClient;
use GRPC\Ping\PingServiceInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\EnvironmentInterface;
use Spiral\Config\ConfiguratorInterface;
use Spiral\Core\Container;
use Spiral\Core\InterceptableCore;
use Spiral\RoadRunnerBridge\GRPC\Interceptor\ServiceClientCore;

class ServiceBootloader extends Bootloader
{
    public function __construct(
        private readonly ConfiguratorInterface $config,
    ) {
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
                    MailerServiceClient::class => ['host' => $env->get('MAILER_SERVICE_HOST', '127.0.0.1:9000')],
                    PingServiceClient::class => ['host' => $env->get('PING_SERVICE_HOST', '127.0.0.1:9001')],
                    PingServiceClient::class => ['host' => $env->get('PING_SERVICE_HOST', '127.0.0.1:9002')],
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
            MailerServiceInterface::class,
            static function(GRPCServicesConfig $config) use($container): MailerServiceInterface
            {
                $service = $config->getService(MailerServiceClient::class);
                $core = new InterceptableCore(new ServiceClientCore(
                    $service['host'],
                    ['credentials' => $service['credentials'] ?? $config->getDefaultCredentials()]
                ));

                foreach ($config->getInterceptors() as $interceptor) {
                    $core->addInterceptor($container->get($interceptor));
                }

                return $container->make(MailerServiceClient::class, ['core' => $core]);
            }
        );
        $container->bindSingleton(
            PingServiceInterface::class,
            static function(GRPCServicesConfig $config) use($container): PingServiceInterface
            {
                $service = $config->getService(PingServiceClient::class);
                $core = new InterceptableCore(new ServiceClientCore(
                    $service['host'],
                    ['credentials' => $service['credentials'] ?? $config->getDefaultCredentials()]
                ));

                foreach ($config->getInterceptors() as $interceptor) {
                    $core->addInterceptor($container->get($interceptor));
                }

                return $container->make(PingServiceClient::class, ['core' => $core]);
            }
        );
        $container->bindSingleton(
            PingServiceInterface::class,
            static function(GRPCServicesConfig $config) use($container): PingServiceInterface
            {
                $service = $config->getService(PingServiceClient::class);
                $core = new InterceptableCore(new ServiceClientCore(
                    $service['host'],
                    ['credentials' => $service['credentials'] ?? $config->getDefaultCredentials()]
                ));

                foreach ($config->getInterceptors() as $interceptor) {
                    $core->addInterceptor($container->get($interceptor));
                }

                return $container->make(PingServiceClient::class, ['core' => $core]);
            }
        );
    }
}
