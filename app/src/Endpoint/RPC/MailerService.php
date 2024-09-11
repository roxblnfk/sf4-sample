<?php

declare(strict_types=1);

namespace App\Endpoint\RPC;

use GRPC\Mailer\SendMailRequest;
use GRPC\Mailer\SendMailResponse;
use Psr\Log\LoggerInterface;
use Spiral\RoadRunner\GRPC;

/**
 * @link https://spiral.dev/docs/grpc-configuration
 */
final class MailerService implements \GRPC\Mailer\MailerServiceInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        // private readonly MailSenderInterface $mailSender,
    ) {
    }

    public function SendMail(GRPC\ContextInterface $ctx, SendMailRequest $in): SendMailResponse
    {
        $this->logger->info('Got request to send email', ['to' => $in->getTo()]);

        // $this->mailSender->send(new Message($in->getSubject(), $in->getBody()));

        return new SendMailResponse();
    }
}
