<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class CaseEscalationView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['caseId', 'escalations'];
    }
}
