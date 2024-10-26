<?php

declare(strict_types=1);

namespace App\Module\Blog\Domain\Share;

enum ShareType: string
{
    /**
     * Internal {@see Post}.
     */
    case Post = 'post';
    case External = 'external';
}
