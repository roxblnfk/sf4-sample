<?php

declare(strict_types=1);

namespace App\Module\Blog\Api\Dto;

final readonly class PostPreview {
    public function __construct(
        public string $uuid,
        public string $title,
        public string $description,
        public string $author,
        public int $commentsCount,
        public \DateTimeImmutable $createdAt,
    ) {}
}
