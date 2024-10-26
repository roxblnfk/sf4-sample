<?php

declare(strict_types=1);

use Cycle\ORM\Collection\ArrayCollectionFactory;
use Cycle\ORM\Collection\DoctrineCollectionFactory;
use Cycle\ORM\Collection\IlluminateCollectionFactory;
use Cycle\ORM\Collection\LoophpCollectionFactory;

/**
 * Configuration for Cycle ORM.
 *
 * @link https://spiral.dev/docs/basics-orm#orm
 * @see \Spiral\Cycle\Config\CycleConfig
 */
return [
    'schema' => [
        /**
         * true (Default) - Schema will be stored in a cache after compilation.
         * It won't be changed after entity modification. Use `php app.php cycle` to update schema.
         *
         * false - Schema won't be stored in a cache after compilation.
         * It will be automatically changed after entity modification. (Development mode)
         */
        'cache' => env('CYCLE_SCHEMA_CACHE', true),

        /**
         * The CycleORM provides the ability to manage default settings for
         * every schema with not defined segments
         */
        'defaults' => [
            // SchemaInterface::MAPPER => \Cycle\ORM\Mapper\Mapper::class,
            // SchemaInterface::REPOSITORY => \Cycle\ORM\Select\Repository::class,
            // SchemaInterface::SCOPE => null,
            // SchemaInterface::TYPECAST_HANDLER => [
            //    \Cycle\ORM\Parser\Typecast::class, \App\Infrastructure\CycleORM\Typecaster\UuidTypecast::class,
            // ],
        ],

        'collections' => [
            'default' => 'array',
            'factories' => ['array' => new ArrayCollectionFactory()],
        ],
    ],

    'warmup' => env('CYCLE_SCHEMA_WARMUP', false),
];
