<?php

declare(strict_types=1);

namespace App\Module\Messenger\Consumer;

use App\Module\Messenger\Domain\SendEmail;
use Spiral\Core\Attribute\Singleton;
use Spiral\Core\Internal\Introspector;
use Spiral\Messenger\Attribute\HandlerMethod;

#[Singleton]
final readonly class SendEmailHandler
{
    #[HandlerMethod]
    public function __invoke(SendEmail $email): void
    {
        trap(Consumer: 'Got task to send Email. Scope: ' . Introspector::scopeName());
    }
}
