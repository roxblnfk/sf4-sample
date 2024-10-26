<?php

declare(strict_types=1);

namespace App\Module\Blog\Api;

use App\Module\Blog\Api\Dto\PostPreview;

interface PublicationsRepository
{
    /**
     * @return iterable<PostPreview>
     */
    public function getPosts(): iterable;
}
