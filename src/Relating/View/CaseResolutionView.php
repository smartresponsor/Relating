<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class CaseResolutionView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['caseId', 'resolution'];
    }
}
