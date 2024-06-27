<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Service\CreateUserService;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

/**
 * Simple home page controller. It renders home page template and also provides
 * an example of exception page.
 */
final class Api
{
    /**
     * Read more about Prototyping:
     * @link https://spiral.dev/docs/basics-prototype/#installation
     */
    use PrototypeTrait;

    #[Route(route: '/api/user/list')]
    public function list(UserRepositoryInterface $repository): array
    {
        return User::findAll();
    }

    #[Route(route: '/api/user/new', methods: ['POST'])]
    public function add(CreateUserService $service): User
    {
        // Generate random username and email
        $username = \bin2hex(\random_bytes(5));
        $email = \bin2hex(\random_bytes(5)) . '@example.com';

        return $service->create($username, $email);
    }

    #[Route(route: '/api/user/edit', methods: ['POST'])]
    public function edit(CreateUserService $service, ServerRequestInterface $request): User
    {
        $data = $request->getParsedBody();

        \is_scalar($data['id'] ?? null) or throw new \InvalidArgumentException('Invalid ID');
        $user = User::findByPK($data['id']) ?? throw new \InvalidArgumentException('User not found');

        $service->edit($user, $data);

        return $user;
    }

    #[Route(route: '/api/user/<id>', methods: ['DELETE'])]
    public function remove(string $id, CreateUserService $service): void
    {
        $service->remove($id);
    }
}
