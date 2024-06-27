<?php

declare(strict_types=1);

namespace App\Module\User\Internal;

use App\Module\User\Domain\Entity\UserInterface;
use App\Module\User\Domain\Service\UserServiceInterface as ServiceInterface;

/**
 * Simple service that creates new user.
 */
final class UserService implements ServiceInterface
{
    public function __construct(
        private readonly UserRepository $repository
    ) {}

    public function create(string $username, string $email): User
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->saveOrFail();

        return $user;
    }

    public function remove(string $id): void
    {
        $this->repository->findByPK($id)?->deleteOrFail();
    }

    public function edit(UserInterface $user, array $data): void
    {
        \assert($user instanceof User);

        \array_key_exists('username', $data) && \is_scalar($data['username']) and $user->username = $data['username'];
        \array_key_exists('email', $data) && \is_scalar($data['email']) and $user->email = $data['email'];

        $user->saveOrFail();
    }
}