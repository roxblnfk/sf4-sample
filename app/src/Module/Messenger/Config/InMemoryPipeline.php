<?php

declare(strict_types=1);

namespace App\Module\Messenger\Config;

use Spiral\Messenger\Attribute\PipelineDefinition;
use Spiral\Messenger\Pipeline\PipelineInterface;
use Spiral\RoadRunner\Jobs\Queue\CreateInfoInterface;
use Spiral\RoadRunner\Jobs\Queue\MemoryCreateInfo;

#[PipelineDefinition('in-memory')]
final readonly class InMemoryPipeline implements PipelineInterface
{
    public function info(): CreateInfoInterface
    {
        return new MemoryCreateInfo('local');
    }

    public function shouldConsume(): bool
    {
        return true;
    }

    public function shouldBeUsed(): bool
    {
        return true;
    }
}
