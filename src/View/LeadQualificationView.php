<?php

declare(strict_types=1);

namespace App\View;

final readonly class LeadQualificationView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['leadId', 'status', 'temperature', 'score', 'reasons'];
    }
}
