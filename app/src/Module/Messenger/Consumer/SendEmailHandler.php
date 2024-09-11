<?php

declare(strict_types=1);

namespace App\Module\Messenger\Consumer;

use App\Module\Messenger\Domain\SendWelcomeMail;
use App\Module\Messenger\Internal\RequestRandomNumber;
use Google\Protobuf\Timestamp;
use GRPC\Mailer\MailerServiceInterface;
use GRPC\Mailer\SendMailRequest;
use Spiral\Core\Attribute\Singleton;
use Spiral\Core\Internal\Introspector;
use Spiral\Messenger\Attribute\HandlerMethod;
use Spiral\RoadRunner\GRPC\Context;

#[Singleton]
final readonly class SendEmailHandler
{
    public function __construct(
        private MailerServiceInterface $mailerService,
    ) {
    }

    #[HandlerMethod]
    public function __invoke(SendWelcomeMail $email, RequestRandomNumber $number): void
    {
        trap(Introspector::scopeNames());
        trap($number->value);
        trap(Consumer: 'Got task to send Email. Scope: ' . Introspector::scopeName());

        // Send GRPC request to email service
        $this->mailerService->SendMail(
            new Context([]),
            (new SendMailRequest())
                ->setTo($email->email)
                ->setSubject("Welcome!")
                ->setBody("Hello, {$email->name}!")
                ->setDeadline((new Timestamp())->setSeconds(time() + 60)),
        );
    }
}
