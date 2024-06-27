<?php

declare(strict_types=1);

namespace App\Module\User\Internal;

use App\Module\User\Domain\Exception\UserNotFoundException;
use App\Module\User\Domain\Service\UserRepositoryInterface;
use Cycle\ORM\Select\Repository;

/**
 * @template TUser of User
 * @extends Repository<TUser>
 */
final class UserRepository extends Repository implements UserRepositoryInterface
{
    public function getById(int $id): User
    {
        return $this->findByPK($id) ?? throw new UserNotFoundException();
    }

    public function getAll(): array
    {
        return $this->select()->fetchAll();
    }
}
