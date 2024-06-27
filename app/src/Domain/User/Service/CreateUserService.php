<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\User\Entity\User;

/**
 * Simple service that creates new user.
 */
final class CreateUserService
{
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
        User::findByPK($id)?->deleteOrFail();
    }

    public function edit(User $user, array $data): void
    {
        \array_key_exists('username', $data)  && \is_scalar($data['username']) and $user->username = $data['username'];
        \array_key_exists('email', $data) && \is_scalar($data['email']) and $user->email = $data['email'];

        $user->saveOrFail();
    }
}
