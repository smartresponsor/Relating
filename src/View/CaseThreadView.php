<?php

declare(strict_types=1);

namespace App\View;

final readonly class CaseThreadView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['caseId', 'thread'];
    }
}
