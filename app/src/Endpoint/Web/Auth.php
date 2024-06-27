<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Module\User\Internal\User;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Auth\AuthContextInterface;
use Spiral\Auth\TokenStorageInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

/**
 * Simple home page controller. It renders home page template and also provides
 * an example of exception page.
 */
final class Auth
{
    /**
     * Read more about Prototyping:
     * @link https://spiral.dev/docs/basics-prototype/#installation
     */
    use PrototypeTrait;

    #[Route(route: '/auth', methods: ['POST'])]
    public function logIn(ServerRequestInterface $request, TokenStorageInterface $storage, AuthContextInterface $authContext): void
    {
        $data = $request->getParsedBody();

        \is_scalar($data['id'] ?? null) or throw new \InvalidArgumentException('Invalid ID');

        User::findByPK($data['id']) ?? throw new \InvalidArgumentException('User not found');
        $token = $storage->create(['userID' => $data['id']]);

        $authContext->start($token);
    }

    #[Route(route: '/logout')]
    public function logout(AuthContextInterface $authContext): void
    {
        $authContext->close();
    }
}
