<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Module\User\Domain\Entity\UserInterface;
use Exception;
use Spiral\Domain\Annotation\Guarded;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

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
    public function index(?UserInterface $user): string
    {
        return $this->views->render('home', data: [
            'user' => $user,
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
