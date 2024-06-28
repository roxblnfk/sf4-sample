<?php

declare(strict_types=1);

namespace App\Endpoint\RPC;

use App\Module\Mailer\Api\MailSenderInterface;
use GRPC\Ping\SendMailRequest;
use GRPC\Ping\SendMailResponse;
use Psr\Log\LoggerInterface;
use Spiral\Mailer\Message;
use Spiral\RoadRunner\GRPC;

/**
 * @link https://spiral.dev/docs/grpc-configuration
 */
final class MailerService implements \GRPC\Ping\MailerServiceInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly MailSenderInterface $mailSender,
    ) {
    }

    public function SendMail(GRPC\ContextInterface $ctx, SendMailRequest $in): SendMailResponse
    {
        $this->logger->info('Got request to send email', ['to' => $in->getTo()]);

        $this->mailSender->send(new Message($in->getSubject(), $in->getBody()));

        return new SendMailResponse();
    }
}
