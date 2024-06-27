<?php

declare(strict_types=1);

namespace App\Module\User\Domain\Service;

use App\Module\User\Domain\Entity\UserInterface;
use App\Module\User\Domain\Exception\UserNotFoundException;

interface UserRepositoryInterface
{
    /**
     * @throws UserNotFoundException
     */
    public function getById(int $id): UserInterface;

    /**
     * @return UserInterface[]
     */
    public function getAll(): array;
}
