<?php

declare(strict_types=1);

namespace App\Module\Blog\Internal\Share;


use App\Module\Blog\Api\Dto\PostPreview;
use App\Module\Blog\Api\PublicationsRepository;
use App\Module\Blog\Domain\Share;
use Cycle\ActiveRecord\Repository\ActiveRepository;

/**
 * @method ShareQuery select()
 * @extends ActiveRepository<Share>
 */
final class PublishedRepository implements PublicationsRepository
{
    public function getPosts(): iterable
    {
        $result = [];
        $shares = $this->select()->limit(20)->fetchAll();
        foreach ($shares as $share) {
            $result[] = new PostPreview(
                (string) $share->uuid,
                'title',
                'foo bar',
                '',
                42,
                $share->createdAt,
            );
        }

        return $result;
    }

    private function select(): ShareQuery
    {
        return (new ShareQuery())->published();
    }
}
