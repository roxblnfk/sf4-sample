<?php

declare(strict_types=1);

namespace App\Module\Mailer\Api;

use Spiral\Mailer\MessageInterface;

interface MailSenderInterface
{
    public function send(MessageInterface $message): void;
}
