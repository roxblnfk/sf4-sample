<?php

declare(strict_types=1);

namespace App\Module\User;

use App\Module\User\Domain\Entity\UserInterface;
use App\Module\User\Domain\Service\UserServiceInterface;
use App\Module\User\Domain\Service\UserRepositoryInterface;
use App\Module\User\Internal\UserService;
use App\Module\User\Internal\UserRepository;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Security\ActorInterface;

final class UserBootloader extends Bootloader
{
    public function defineSingletons(): array
    {
        return [
            UserInterface::class => ActorInterface::class,
            UserRepositoryInterface::class => UserRepository::class,
            UserServiceInterface::class => UserService::class,
        ];
    }
}
