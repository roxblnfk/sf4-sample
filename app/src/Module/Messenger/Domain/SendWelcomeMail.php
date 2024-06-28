<?php

declare(strict_types=1);

namespace App\Module\Messenger\Domain;

use Spiral\Messenger\Attribute\Pipeline;
use Spiral\Messenger\Attribute\Serializer;

#[Pipeline('in-memory')]
#[Serializer('json')]
final readonly class SendWelcomeMail
{
    public function __construct(
        public int $userId,
        public string $email,
        public string $name,
    ) {
    }
}
