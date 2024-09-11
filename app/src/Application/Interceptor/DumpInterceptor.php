<?php

declare(strict_types=1);

namespace App\Application\Interceptor;

use Spiral\Interceptors\Context\CallContextInterface;
use Spiral\Interceptors\HandlerInterface;
use Spiral\Interceptors\InterceptorInterface;

final readonly class DumpInterceptor implements InterceptorInterface {

    public function intercept(CallContextInterface $context, HandlerInterface $handler): mixed
    {
        trap(DumpInterceptor: $context)->stackTrace();
        return $handler->handle($context);
    }
}
