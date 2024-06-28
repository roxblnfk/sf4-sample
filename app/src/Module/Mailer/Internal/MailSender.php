<?php

declare(strict_types=1);

namespace App\Module\Mailer\Internal;

use Spiral\Mailer\MailerInterface;
use Spiral\Mailer\MessageInterface;

final readonly class MailSender implements \App\Module\Mailer\Api\MailSenderInterface
{
    public function __construct(
        private MailerInterface $mailer,
    ) {}

    public function send(MessageInterface $message): void
    {
        $this->mailer->send($message);
    }
}
