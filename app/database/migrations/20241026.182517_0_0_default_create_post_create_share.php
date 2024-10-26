<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefaultCaf29c03655836c25f08141cce8efb00 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('post')
        ->addColumn('uuid', 'uuid', ['nullable' => false, 'defaultValue' => null, 'size' => 36])
        ->addColumn('title', 'string', ['nullable' => false, 'defaultValue' => null, 'size' => 255])
        ->addColumn('content', 'text', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('createdAt', 'datetime', ['nullable' => false, 'defaultValue' => 'CURRENT_TIMESTAMP'])
        ->setPrimaryKeys(['uuid'])
        ->create();
        $this->table('share')
        ->addColumn('uuid', 'uuid', ['nullable' => false, 'defaultValue' => null, 'size' => 36])
        ->addColumn('type', 'string', ['nullable' => false, 'defaultValue' => null, 'size' => 255])
        ->addColumn('visibility', 'smallInteger', [
            'nullable' => false,
            'defaultValue' => 1,
            'size' => 6,
            'autoIncrement' => false,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->addColumn('post_uuid', 'uuid', ['nullable' => true, 'defaultValue' => null, 'size' => 36])
        ->addColumn('external_link', 'string', ['nullable' => true, 'defaultValue' => null, 'size' => 255])
        ->addColumn('is_published', 'boolean', [
            'nullable' => false,
            'defaultValue' => null,
            'size' => 1,
            'autoIncrement' => false,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->addColumn('published_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('createdAt', 'datetime', ['nullable' => false, 'defaultValue' => 'CURRENT_TIMESTAMP'])
        ->addIndex(['post_uuid'], ['name' => 'share_index_post_uuid_671d340d93e9a', 'unique' => false])
        ->addForeignKey(['post_uuid'], 'post', ['uuid'], [
            'name' => 'share_foreign_post_uuid_671d340d93ef5',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->setPrimaryKeys(['uuid'])
        ->create();
    }

    public function down(): void
    {
        $this->table('share')->drop();
        $this->table('post')->drop();
    }
}
