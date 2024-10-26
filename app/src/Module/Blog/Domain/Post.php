<?php

declare(strict_types=1);

namespace App\Module\Blog\Domain;

use App\Module\Blog\Domain\Post\Content;
use App\Module\Blog\Domain\Post\Title;
use Cycle\Annotated\Annotation as ORM;
use Cycle\ORM\Entity\Behavior;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(role: 'post', table: 'post')]
#[ORM\Table\PrimaryKey(columns: ['uuid'])]
#[Behavior\Uuid\Uuid7(field: 'uuid')]
#[Behavior\CreatedAt(field: 'createdAt')]
class Post extends \App\Module\Common\Domain\Entity
{
    #[ORM\Column(type: 'uuid', primary: true)]
    public UuidInterface $uuid;

    #[ORM\Column(type: 'string', typecast: Title::class)]
    public Title $title;

    #[ORM\Column(type: 'text', typecast: Content::class)]
    public Content $content;

    public \DateTimeInterface $createdAt;

    #[ORM\Relation\HasOne(target: Share::class, innerKey: 'uuid', outerKey: 'postUuid', nullable: true)]
    public ?Share $post = null;
}
