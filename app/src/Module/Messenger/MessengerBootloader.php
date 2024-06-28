<?php

declare(strict_types=1);

namespace App\Module\Messenger;

use Spiral\Boot\Bootloader\Bootloader;

final class MessengerBootloader extends Bootloader
{
    protected const DEPENDENCIES = [
        \Spiral\Messenger\Bootloader\MessengerBootloader::class,
    ];
}
