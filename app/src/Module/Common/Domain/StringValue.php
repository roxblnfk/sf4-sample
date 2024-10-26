<?php

declare(strict_types=1);

namespace App\Module\Common\Domain;

abstract readonly class StringValue
{
    final private function __construct(
        public string $value,
    ) {}


    public function __toString(): string
    {
        return $this->value;
    }

    public static function create(string $value): static
    {
        return new static($value);
    }

    public static function castValue(string $value): static
    {
        return new static($value);
    }
}
