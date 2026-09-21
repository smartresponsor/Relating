<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

interface RelationRelatingViewSchemaInterface
{
    /**
     * @return list<string>
     */
    public static function expectedKeys(): array;
}
