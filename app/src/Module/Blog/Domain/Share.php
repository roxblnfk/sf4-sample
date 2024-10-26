<?php

declare(strict_types=1);

namespace App\Module\Blog\Domain;

use App\Module\Blog\Domain\Share\ExternalLink;
use App\Module\Blog\Domain\Share\ShareType;
use App\Module\Blog\Domain\Share\Visibility;
use Cycle\Annotated\Annotation as ORM;
use Cycle\ORM\Entity\Behavior;
use Ramsey\Uuid\UuidInterface;

/**
 * Provides a way to publish content.
 */
#[ORM\Entity(role: 'share', table: 'share')]
#[Behavior\Uuid\Uuid7(field: 'uuid')]
#[Behavior\CreatedAt(field: 'createdAt')]
class Share extends \App\Module\Common\Domain\Entity
{
    #[ORM\Column(type: 'uuid', primary: true)]
    public UuidInterface $uuid;

    #[ORM\Column(type: 'string', typecast: ShareType::class)]
    public ShareType $type;

    #[ORM\Column(type: 'smallInteger', default: Visibility::Registered->value, typecast: Visibility::class)]
    public Visibility $visibility = Visibility::Registered;

    #[ORM\Column(type: 'uuid', nullable: true, typecast: 'uuid')]
    public ?UuidInterface $postUuid = null;

    #[ORM\Column(type: 'string', nullable: true, typecast: [ExternalLink::class, 'castValue'])]
    public ?ExternalLink $externalLink = null;

    #[ORM\Column(type: 'boolean')]
    public bool $isPublished = false;

    #[ORM\Column(type: 'datetime')]
    public \DateTimeImmutable $publishedAt;

    /**
     * When the entity was created.
     */
    public \DateTimeImmutable $createdAt;

    #[ORM\Relation\BelongsTo(target: Post::class, innerKey: 'postUuid', outerKey: 'uuid', nullable: true)]
    public ?Post $post = null;
}
