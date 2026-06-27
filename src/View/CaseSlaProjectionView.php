<?php

declare(strict_types=1);


namespace App\View;

final readonly class CaseSlaProjectionView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'case.sla.projection';
    }

    /**
     * @return list<string>
     */
    public static function expectedKeys(): array
    {
        return ['caseSla'];
    }
}
