<?php

declare(strict_types=1);

namespace App\Endpoint\Api;

use App\Module\Blog\Api\PublicationsRepository;
use Spiral\Router\Annotation\Route;

final class Articles
{
    #[Route(route: '/api/articles/list', group: 'api')]
    public function list(PublicationsRepository $repository): array
    {
        // Share::make([
        //     'type' => ShareType::External,
        //     'externalLink' => Share\ExternalLink::create('https://habr.com'),
        //     'isPublished' => true,
        //     'publishedAt' => new \DateTimeImmutable(),
        //     'visibility' => Visibility::All,
        // ])->saveOrFail();
        return ['articles' => $repository->getPosts()];
    }
}
