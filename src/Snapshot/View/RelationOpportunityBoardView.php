<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationOpportunityBoardView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'opportunity.board';
    }

    public static function expectedKeys(): array
    {
        return ['pipelineId', 'columns', 'generatedAt'];
    }
}
