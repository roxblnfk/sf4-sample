<?php

declare(strict_types=1);

namespace GRPC\Ping;

use Spiral\Core\InterceptableCore;
use Spiral\RoadRunner\GRPC\ContextInterface;

class MailerServiceClient implements MailerServiceInterface
{
    public function __construct(
        private readonly InterceptableCore $core,
    ) {
    }

    public function SendMail(ContextInterface $ctx, SendMailRequest $in): SendMailResponse
    {
        [$response, $status] = $this->core->callAction(MailerServiceInterface::class, '/'.self::NAME.'/SendMail', [
            'in' => $in,
            'ctx' => $ctx,
            'responseClass' => \GRPC\Ping\SendMailResponse::class,
        ]);

        return $response;
    }
}
