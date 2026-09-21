<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationLeadQualificationView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['leadId', 'status', 'temperature', 'score', 'reasons'];
    }
}
