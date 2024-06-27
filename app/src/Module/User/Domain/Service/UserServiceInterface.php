<?php

declare(strict_types=1);

namespace App\Module\User\Domain\Service;

use App\Module\User\Domain\Entity\UserInterface;

interface UserServiceInterface
{
    public function create(string $username, string $email): UserInterface;

    public function remove(string $id): void;

    public function edit(UserInterface $user, array $data): void;
}
