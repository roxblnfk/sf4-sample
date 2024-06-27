<?php

declare(strict_types=1);

namespace App\Module\User\Domain\Entity;

use JsonSerializable;
use Spiral\Security\ActorInterface;

interface UserInterface extends JsonSerializable, ActorInterface
{
    public function getId(): int;

    public function getUsername(): string;

    public function getEmail(): string;
}
