<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationCaseSlaProjectionView extends RelationAbstractArrayView
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
