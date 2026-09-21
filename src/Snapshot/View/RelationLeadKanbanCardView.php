<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationLeadKanbanCardView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'lead.kanban';
    }

    public static function expectedKeys(): array
    {
        return ['id', 'title', 'status', 'temperature', 'score', 'nextActionAt'];
    }
}
