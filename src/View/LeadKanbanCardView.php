<?php

declare(strict_types=1);

namespace App\View;

final readonly class LeadKanbanCardView extends AbstractArrayView
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
