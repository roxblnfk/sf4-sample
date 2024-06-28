<?php

declare(strict_types=1);

namespace App\Module\Messenger\Domain;

use Spiral\Messenger\Attribute\Pipeline;
use Spiral\Messenger\Attribute\Serializer;

#[Pipeline('in-memory')]
#[Serializer('json')]
final readonly class SendEmail
{
}
