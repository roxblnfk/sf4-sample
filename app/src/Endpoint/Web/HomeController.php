<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use Exception;
use Spiral\Domain\Annotation\Guarded;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;
use Spiral\Security\ActorInterface;

/**
 * Simple home page controller. It renders home page template and also provides
 * an example of exception page.
 */
final class HomeController
{
    /**
     * Read more about Prototyping:
     * @link https://spiral.dev/docs/basics-prototype/#installation
     */
    use PrototypeTrait;

    #[Guarded]
    #[Route(route: '/', name: 'index')]
    public function index(ActorInterface $actor): string
    {
        return $this->views->render('home', data: [
            'actor' => $actor,
        ]);
    }

    /**
     * Example of exception page.
     */
    #[Route(route: '/exception', name: 'exception')]
    public function exception(): never
    {
        throw new Exception('This is a test exception.');
    }
}
