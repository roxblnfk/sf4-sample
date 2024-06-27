<?php

declare(strict_types=1);

namespace App\Module\User\Internal;

use App\Module\User\Domain\Entity\UserInterface;
use Cycle\ActiveRecord\ActiveRecord;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(
    repository: UserRepository::class,
)]
class User extends ActiveRecord implements UserInterface
{
    /** @psalm-suppress PropertyNotSetInConstructor */
    #[Column(type: 'primary')]
    private int $id;

    #[Column(type: 'string')]
    public string $username;

    #[Column(type: 'string')]
    public string $email;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
        ];
    }

    public function getRoles(): array
    {
        return [];
    }
}
