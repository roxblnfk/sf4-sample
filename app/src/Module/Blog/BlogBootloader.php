<?php

declare(strict_types=1);

namespace App\Module\Blog;

use Spiral\Boot\Bootloader\Bootloader;

final class BlogBootloader extends Bootloader
{
    public function defineBindings(): array
    {
        return [
            Api\PublicationsRepository::class => Internal\Share\PublishedRepository::class,
        ];
    }
}
