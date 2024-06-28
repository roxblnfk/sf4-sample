<?php

declare(strict_types=1);

namespace App\Module\Mailer;

use App\Module\Mailer\Api\MailSenderInterface;
use App\Module\Mailer\Internal\MailSender;
use Spiral\Boot\Bootloader\Bootloader;

final class MailerBootloader extends Bootloader
{
    public function defineDependencies(): array
    {
        return [
            \Spiral\SendIt\Bootloader\MailerBootloader::class,
        ];
    }

    public function defineSingletons(): array
    {
        return [
            MailSenderInterface::class => MailSender::class,
        ];
    }
}
