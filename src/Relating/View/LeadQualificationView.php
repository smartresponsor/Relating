<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class LeadQualificationView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['leadId', 'status', 'temperature', 'score', 'reasons'];
    }
}
