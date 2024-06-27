<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Module\User\Domain\Entity\UserInterface;
use App\Module\User\Domain\Service\UserServiceInterface;
use App\Module\User\Domain\Service\UserRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

/**
 * Simple home page controller. It renders home page template and also provides
 * an example of exception page.
 */
final class UserApi
{
    /**
     * Read more about Prototyping:
     * @link https://spiral.dev/docs/basics-prototype/#installation
     */
    use PrototypeTrait;

    #[Route(route: '/api/user/list')]
    public function list(UserRepositoryInterface $repository): array
    {
        return $repository->getAll();
    }

    #[Route(route: '/api/user/new', methods: ['POST'])]
    public function add(UserServiceInterface $service): UserInterface
    {
        // Generate random username and email
        $username = \bin2hex(\random_bytes(5));
        $email = \bin2hex(\random_bytes(5)) . '@example.com';

        return $service->create($username, $email);
    }

    #[Route(route: '/api/user/edit', methods: ['POST'])]
    public function edit(
        UserRepositoryInterface $repository,
        UserServiceInterface $service,
        ServerRequestInterface $request,
    ): UserInterface {
        $data = $request->getParsedBody();

        \is_scalar($data['id'] ?? null) or throw new \InvalidArgumentException('Invalid ID');
        $user = $repository->getById($data['id']);

        $service->edit($user, $data);

        return $user;
    }

    #[Route(route: '/api/user/<id>', methods: ['DELETE'])]
    public function remove(string $id, UserServiceInterface $service): void
    {
        $service->remove($id);
    }
}
