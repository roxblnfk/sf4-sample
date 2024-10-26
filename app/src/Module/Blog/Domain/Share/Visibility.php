<?php

declare(strict_types=1);

namespace App\Module\Blog\Domain\Share;

enum Visibility: int
{
    /**
     * All users
     */
    case All = 0;
    /**
     * Registered users
     */
    case Registered = 1;
    /**
     * Content makers
     */
    case Makers = 2;
    /**
     * Anyone with a link
     */
    case Link = 3;
}
