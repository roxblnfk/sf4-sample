<?php

declare(strict_types=1);

namespace App\Module\Messenger;

use App\Module\Messenger\Internal\RequestRandomNumber;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\BinderInterface;

final class MessengerBootloader extends Bootloader
{
    protected const DEPENDENCIES = [
        \Spiral\Messenger\Bootloader\MessengerBootloader::class,
    ];

    public function boot(BinderInterface $binder): void
    {
        $binder->getBinder('queue-task')->bindSingleton(
            RequestRandomNumber::class,
            static fn() => RequestRandomNumber::create(),
        );
    }
}
