<?php

declare(strict_types=1);

namespace App\View;

final readonly class CaseResolutionView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['caseId', 'resolution'];
    }
}
