<?php

declare(strict_types=1);

namespace App\Snapshot\View;

interface RelatingViewSchemaInterface
{
    /**
     * @return list<string>
     */
    public static function expectedKeys(): array;
}
