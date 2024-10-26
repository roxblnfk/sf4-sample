<?php

declare(strict_types=1);

namespace App\Module\Blog\Internal\Share;

use App\Module\Blog\Domain\Share;
use Cycle\ActiveRecord\Query\ActiveQuery;

/**
 * @extends ActiveQuery<Share>
 */
final class ShareQuery extends ActiveQuery
{
    public function __construct()
    {
        parent::__construct(Share::class);
    }

    public function published(bool $value = true): static
    {
        /** @see Share::$isPublished */
        return $this->where('isPublished', $value);
    }

    public function visibleFor(Share\Visibility $visibility): self
    {
        /** @see Share::$visibility */
        return $this->where('visibility', '<=', $visibility->value);
    }
}
