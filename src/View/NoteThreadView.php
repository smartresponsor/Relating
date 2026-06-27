<?php

declare(strict_types=1);

namespace App\View;

final readonly class NoteThreadView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['target', 'notes'];
    }
}
