<?php

declare(strict_types=1);

namespace App\Module\Messenger\Internal;

use Spiral\Core\Scope;

#[Scope('task')]
final readonly class RequestRandomNumber
{
    private function __construct(
        public int $value,
    ) {}

    public static function create(): self
    {
        return new self(\random_int(1, 100000));
    }
}
