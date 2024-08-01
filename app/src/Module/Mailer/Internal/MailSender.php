<?php

declare(strict_types=1);

namespace App\Module\Mailer\Internal;

use App\Module\Mailer\Api\MailSenderInterface;
use Spiral\Mailer\MailerInterface;
use Spiral\Mailer\MessageInterface;

final readonly class MailSender implements MailSenderInterface
{
    public function __construct(
        private MailerInterface $mailer,
    ) {}

    public function send(MessageInterface $message): void
    {
        $this->mailer->send($message);
    }
}
