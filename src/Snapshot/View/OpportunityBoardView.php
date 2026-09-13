<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class OpportunityBoardView extends AbstractArrayView
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
