<?php

declare(strict_types=1);

namespace App\Module\Auth;

use App\Module\Auth\Internal\Repository;
use App\Module\User\Internal\User;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Bootloader\Auth\HttpAuthBootloader;
use Spiral\Bootloader\Auth\SecurityActorBootloader;
use Spiral\Cycle\Bootloader\AuthTokensBootloader;

final class AuthBootloader extends Bootloader
{
    public function defineDependencies(): array
    {
        return [
            AuthTokensBootloader::class,
            HttpAuthBootloader::class,
            SecurityActorBootloader::class,
        ];
    }

    public function defineSingletons(): array
    {
        return [
            Repository::class => fn() => new Repository(User::class),
        ];
    }

    public function boot(\Spiral\Bootloader\Auth\AuthBootloader $auth): void
    {
        $auth->addActorProvider(Repository::class);
    }
}
