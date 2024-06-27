<?php

declare(strict_types=1);

namespace App\Module\Auth\Internal;

use App\Module\User\Internal\User;
use Cycle\ActiveRecord\Repository\ActiveRepository;
use Spiral\Auth\ActorProviderInterface;
use Spiral\Auth\TokenInterface;

/**
 * @internal
 * @extends ActiveRepository<User>
 */
class Repository extends ActiveRepository implements ActorProviderInterface
{
    public function getActor(TokenInterface $token): ?User
    {
        $id = $token->getPayload()['userID'] ?? null;
        return $id === null
            ? null
            : $this->findByPK($token->getPayload()['userID']);
    }
}
