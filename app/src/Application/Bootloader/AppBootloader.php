<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use App\Application\Interceptor\DumpInterceptor;
use Spiral\Bootloader\DomainBootloader;
use Spiral\Core\CompatiblePipelineBuilder;
use Spiral\Core\CoreInterface;
use Spiral\Cycle\Interceptor\CycleInterceptor;
use Spiral\DataGrid\Interceptor\GridInterceptor;
use Spiral\Domain\GuardInterceptor;
use Spiral\Interceptors\PipelineBuilderInterface;

/**
 * @link https://spiral.dev/docs/http-interceptors
 */
final class AppBootloader extends DomainBootloader
{
    protected const SINGLETONS = [
        CoreInterface::class => [self::class, 'domainCore'],
        PipelineBuilderInterface::class => CompatiblePipelineBuilder::class,
    ];

    protected const INTERCEPTORS = [
        DumpInterceptor::class,
        CycleInterceptor::class,
        GridInterceptor::class,
        GuardInterceptor::class,
    ];
}
