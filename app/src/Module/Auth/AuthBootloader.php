<?php

declare(strict_types=1);

namespace App\Module\Auth;

use App\Domain\User\Entity\User;
use App\Module\Auth\Internal\Repository;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Bootloader\Auth\HttpAuthBootloader;
use Spiral\Cycle\Bootloader\AuthTokensBootloader;

final class AuthBootloader extends Bootloader
{
    protected const DEPENDENCIES = [
        AuthTokensBootloader::class,
        HttpAuthBootloader::class,
    ];

    public function defineSingletons(): array
    {
        return [
            // ActorProviderInterface::class => Repository::class,
            Repository::class => fn() => new Repository(User::class),
        ];
    }

    public function boot(\Spiral\Bootloader\Auth\AuthBootloader $auth): void
    {
        $auth->addActorProvider(Repository::class);
    }
}
