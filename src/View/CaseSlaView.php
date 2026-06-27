<?php

declare(strict_types=1);

namespace App\View;

final readonly class CaseSlaView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['caseId', 'deadline', 'status'];
    }
}
