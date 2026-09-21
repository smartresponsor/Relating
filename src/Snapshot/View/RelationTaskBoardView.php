<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationTaskBoardView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'task.board';
    }

    public static function expectedKeys(): array
    {
        return ['ownerReference', 'columns', 'generatedAt'];
    }
}
